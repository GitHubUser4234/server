FileList={
	useUndo:true,
	update:function(fileListHtml) {
		$('#fileList').empty().html(fileListHtml);
	},
	addFile:function(name,size,lastModified,loading){
		var img=(loading)?OC.imagePath('core', 'loading.gif'):OC.imagePath('core', 'filetypes/file.png');
		var html='<tr data-type="file" data-size="'+size+'">';
		if(name.indexOf('.')!=-1){
			var basename=name.substr(0,name.lastIndexOf('.'));
			var extension=name.substr(name.lastIndexOf('.'));
		}else{
			var basename=name;
			var extension=false;
		}
		html+='<td class="filename" style="background-image:url('+img+')"><input type="checkbox" />';
		html+='<a class="name" href="download.php?file='+$('#dir').val().replace(/</, '&lt;').replace(/>/, '&gt;')+'/'+name+'"><span class="nametext">'+basename
		if(extension){
			html+='<span class="extension">'+extension+'</span>';
		}
		html+='</span></a></td>';
		if(size!='Pending'){
			simpleSize=simpleFileSize(size);
		}else{
			simpleSize='Pending';
		}
		sizeColor = Math.round(200-size/(1024*1024)*2);
		lastModifiedTime=Math.round(lastModified.getTime() / 1000);
		modifiedColor=Math.round((Math.round((new Date()).getTime() / 1000)-lastModifiedTime)/60/60/24*14);
		html+='<td class="filesize" title="'+humanFileSize(size)+'" style="color:rgb('+sizeColor+','+sizeColor+','+sizeColor+')">'+simpleSize+'</td>';
		html+='<td class="date"><span class="modified" title="'+formatDate(lastModified)+'" style="color:rgb('+modifiedColor+','+modifiedColor+','+modifiedColor+')">'+relative_modified_date(lastModified.getTime() / 1000)+'</span></td>';
		html+='</tr>';
		FileList.insertElement(name,'file',$(html).attr('data-file',name));
		if(loading){
			$('tr').filterAttr('data-file',name).data('loading',true);
		}else{
			$('tr').filterAttr('data-file',name).find('td.filename').draggable(dragOptions);
		}
	},
	addDir:function(name,size,lastModified){
		html = $('<tr></tr>').attr({ "data-type": "dir", "data-size": size, "data-file": name});
		td = $('<td></td>').attr({"class": "filename", "style": 'background-image:url('+OC.imagePath('core', 'filetypes/folder.png')+')' });
		td.append('<input type="checkbox" />');
		var link_elem = $('<a></a>').attr({ "class": "name", "href": OC.linkTo('files', 'index.php')+"&dir="+ encodeURIComponent($('#dir').val()+'/'+name).replace(/%2F/g, '/') });
		link_elem.append($('<span></span>').addClass('nametext').text(name));
		link_elem.append($('<span></span>').attr({'class': 'uploadtext', 'currentUploads': 0}));
		td.append(link_elem);
		html.append(td);
		if(size!='Pending'){
			simpleSize=simpleFileSize(size);
		}else{
			simpleSize='Pending';
		}
		sizeColor = Math.round(200-Math.pow((size/(1024*1024)),2));
		lastModifiedTime=Math.round(lastModified.getTime() / 1000);
		modifiedColor=Math.round((Math.round((new Date()).getTime() / 1000)-lastModifiedTime)/60/60/24*5);
		td = $('<td></td>').attr({ "class": "filesize", "title": humanFileSize(size), "style": 'color:rgb('+sizeColor+','+sizeColor+','+sizeColor+')'}).text(simpleSize);
		html.append(td);

		td = $('<td></td>').attr({ "class": "date" });
		td.append($('<span></span>').attr({ "class": "modified", "title": formatDate(lastModified), "style": 'color:rgb('+modifiedColor+','+modifiedColor+','+modifiedColor+')' }).text( relative_modified_date(lastModified.getTime() / 1000) ));
		html.append(td);
		FileList.insertElement(name,'dir',html);
		$('tr').filterAttr('data-file',name).find('td.filename').draggable(dragOptions);
		$('tr').filterAttr('data-file',name).find('td.filename').droppable(folderDropOptions);
	},
	refresh:function(data) {
		result = jQuery.parseJSON(data.responseText);
		if(typeof(result.data.breadcrumb) != 'undefined'){
			updateBreadcrumb(result.data.breadcrumb);
		}
		FileList.update(result.data.files);
		resetFileActionPanel();
	},
	remove:function(name){
		$('tr').filterAttr('data-file',name).find('td.filename').draggable('destroy');
		$('tr').filterAttr('data-file',name).remove();
		if($('tr[data-file]').length==0){
			$('#emptyfolder').show();
			$('.file_upload_filename').addClass('highlight');
		}
	},
	insertElement:function(name,type,element){
		//find the correct spot to insert the file or folder
		var fileElements=$('tr[data-file][data-type="'+type+'"]');
		var pos;
		if(name.localeCompare($(fileElements[0]).attr('data-file'))<0){
			pos=-1;
		}else if(name.localeCompare($(fileElements[fileElements.length-1]).attr('data-file'))>0){
			pos=fileElements.length-1;
		}else{
			for(var pos=0;pos<fileElements.length-1;pos++){
				if(name.localeCompare($(fileElements[pos]).attr('data-file'))>0 && name.localeCompare($(fileElements[pos+1]).attr('data-file'))<0){
					break;
				}
			}
		}
		if(fileElements.length){
			if(pos==-1){
				$(fileElements[0]).before(element);
			}else{
				$(fileElements[pos]).after(element);
			}
		}else if(type=='dir' && $('tr[data-file]').length>0){
			$('tr[data-file]').first().before(element);
		}else{
			$('#fileList').append(element);
		}
		$('#emptyfolder').hide();
		$('.file_upload_filename').removeClass('highlight');
	},
	loadingDone:function(name){
		var tr=$('tr').filterAttr('data-file',name);
		tr.data('loading',false);
		var mime=tr.data('mime');
		tr.attr('data-mime',mime);
		getMimeIcon(mime,function(path){
			tr.find('td.filename').attr('style','background-image:url('+path+')');
		});
		tr.find('td.filename').draggable(dragOptions);
	},
	isLoading:function(name){
		return $('tr').filterAttr('data-file',name).data('loading');
	},
	rename:function(name){
		var tr=$('tr').filterAttr('data-file',name);
		tr.data('renaming',true);
		var td=tr.children('td.filename');
		var input=$('<input class="filename"></input>').val(name);
		var form=$('<form></form>')
		form.append(input);
		td.children('a.name').text('');
		td.children('a.name').append(form)
		input.focus();
		form.submit(function(event){
			event.stopPropagation();
			event.preventDefault();
			var newname=input.val();
			if (newname != name) {
				if ($('tr').filterAttr('data-file', newname).length > 0) {
					$('#notification').html(newname+' '+t('files', 'already exists')+'<span class="replace">'+t('files', 'replace')+'</span><span class="cancel">'+t('files', 'cancel')+'</span>');
					$('#notification').data('oldName', name);
					$('#notification').data('newName', newname);
					$('#notification').fadeIn();
					newname = name;
				} else {
					$.get(OC.filePath('files','ajax','rename.php'), { dir : $('#dir').val(), newname: newname, file: name },function(result) {
						if (!result || result.status == 'error') {
							OC.dialogs.alert(result.data.message, 'Error moving file');
							newname = name;
						}
					});
				}
				
			}
			tr.attr('data-file', newname);
			var path = td.children('a.name').attr('href');
			td.children('a.name').attr('href', path.replace(encodeURIComponent(name), encodeURIComponent(newname)));
			if (newname.indexOf('.') > 0) {
				var basename=newname.substr(0,newname.lastIndexOf('.'));
			} else {
				var basename=newname;
			}
			td.children('a.name').empty();
			var span=$('<span class="nametext"></span>');
			span.text(basename);
			td.children('a.name').append(span);
			if (newname.indexOf('.') > 0) {
				span.append($('<span class="extension">'+newname.substr(newname.lastIndexOf('.'))+'</span>'));
			}
			tr.data('renaming',false);
			return false;
		});
		input.click(function(event){
			event.stopPropagation();
			event.preventDefault();
		});
		input.blur(function(){
			form.trigger('submit');
		});
	},
	replace:function(oldName, newName) {
		// Finish any existing actions
		if (FileList.lastAction || !FileList.useUndo) {
			FileList.lastAction();
		}
		var tr = $('tr').filterAttr('data-file', oldName);
		tr.hide();
		FileList.replaceCanceled = false;
		FileList.replaceOldName = oldName;
		FileList.replaceNewName = newName;
		FileList.lastAction = function() { 
			FileList.finishReplace();
		};
		$('#notification').html(t('files', 'replaced')+' '+newName+' '+t('files', 'with')+' '+oldName+'<span class="undo">'+t('files', 'undo')+'</span>');
		$('#notification').fadeIn();
	},
	finishReplace:function() {
		if (!FileList.replaceCanceled && FileList.replaceOldName && FileList.replaceNewName) {
			// Delete the file being replaced and rename the replacement
			FileList.deleteCanceled = false;
			FileList.deleteFiles = [FileList.replaceNewName];
			FileList.finishDelete(function() {
				$.ajax({url: OC.filePath('files', 'ajax', 'rename.php'), async: false, data: { dir: $('#dir').val(), newname: FileList.replaceNewName, file: FileList.replaceOldName }, success: function(result) {
					if (result && result.status == 'success') {
						var tr = $('tr').filterAttr('data-file', FileList.replaceOldName);
						tr.attr('data-file', FileList.replaceNewName);
						var td = tr.children('td.filename');
						td.children('a.name .span').text(FileList.replaceNewName);
						var path = td.children('a.name').attr('href');
						td.children('a.name').attr('href', path.replace(encodeURIComponent(FileList.replaceOldName), encodeURIComponent(FileList.replaceNewName)));
						if (FileList.replaceNewName.indexOf('.') > 0) {
							var basename = FileList.replaceNewName.substr(0, FileList.replaceNewName.lastIndexOf('.'));
						} else {
							var basename = FileList.replaceNewName;
						}
						td.children('a.name').empty();
						var span = $('<span class="nametext"></span>');
						span.text(basename);
						td.children('a.name').append(span);
						if (FileList.replaceNewName.indexOf('.') > 0) {
							span.append($('<span class="extension">'+FileList.replaceNewName.substr(FileList.replaceNewName.lastIndexOf('.'))+'</span>'));
						}
						tr.show();
					} else {
						OC.dialogs.alert(result.data.message, 'Error moving file');
					}
					FileList.replaceCanceled = true;
					FileList.replaceOldName = null;
					FileList.replaceNewName = null;
					FileList.lastAction = null;
				}});
			}, true);
		}
	},
	do_delete:function(files){
		// Finish any existing actions
		if (FileList.lastAction || !FileList.useUndo) {
			FileList.lastAction();
		}
		if(files.substr){
			files=[files];
		}
		$.each(files,function(index,file){
			var files = $('tr').filterAttr('data-file',file);
			files.hide();
			files.find('input[type="checkbox"]').removeAttr('checked');
			files.removeClass('selected');
		});
		procesSelection();
		FileList.deleteCanceled=false;
		FileList.deleteFiles=files;
		FileList.lastAction = function() {
			FileList.finishDelete(null, true);
		};
		$('#notification').html(t('files', 'deleted')+' '+files+'<span class="undo">'+t('files', 'undo')+'</span>');
		$('#notification').fadeIn();
	},
	finishDelete:function(ready,sync){
		if(!FileList.deleteCanceled && FileList.deleteFiles){
			var fileNames=FileList.deleteFiles.join(';');
			$.ajax({
				url: OC.filePath('files', 'ajax', 'delete.php'),
				async:!sync,
				data: {dir:$('#dir').val(),files:fileNames},
				complete: function(data){
					boolOperationFinished(data, function(){
						$('#notification').fadeOut();
						$.each(FileList.deleteFiles,function(index,file){
							FileList.remove(file);
						});
						FileList.deleteCanceled=true;
						FileList.deleteFiles=null;
						FileList.lastAction = null;
						if(ready){
							ready();
						}
					});
				}
			});
		}
	}
}

$(document).ready(function(){
	$('#notification').hide();
	$('#notification .undo').live('click', function(){
		if (FileList.deleteFiles) {
			$.each(FileList.deleteFiles,function(index,file){
				$('tr').filterAttr('data-file',file).show();
			});
			FileList.deleteCanceled=true;
			FileList.deleteFiles=null;
		} else if (FileList.replaceOldName && FileList.replaceNewName) {
			$('tr').filterAttr('data-file', FileList.replaceOldName).show();
			FileList.replaceCanceled = true;
			FileList.replaceOldName = null;
			FileList.replaceNewName = null;
		}
		$('#notification').fadeOut();
	});
	$('#notification .replace').live('click', function() {
		$('#notification').fadeOut('400', function() {
			FileList.replace($('#notification').data('oldName'), $('#notification').data('newName'));
		});
	});
	$('#notification .cancel').live('click', function() {
		$('#notification').fadeOut();
	});
	FileList.useUndo=('onbeforeunload' in window)
	$(window).bind('beforeunload', function (){
		if (FileList.lastAction) {
			FileList.lastAction();
		}
	});
});
