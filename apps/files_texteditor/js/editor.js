function setEditorSize(){
	// Sets the size of the text editor window.
	$('#editor').css('height', $(window).height()-81);
	$('#editor').css('width', $(window).width()-160);
	$('#editor').css('padding-top', '40px');		
}

function getFileExtension(file){
	var parts=file.split('.');
	return parts[parts.length-1];
}

function setSyntaxMode(ext){
	// Loads the syntax mode files and tells the editor
	var filetype = new Array()
	// Todo finish these
	filetype["php"] = "php";
	filetype["html"] = "html";
	filetype["rb"] = "ruby";
	filetype["css"] = "css";
	filetype["pl"] = "perl";
	filetype["py"] = "python";
	filetype["xml"] = "xml";
	filetype["js"] = "javascript";

	if(filetype[ext]!=null){
		// Then it must be in the array, so load the custom syntax mode
		// Set the syntax mode
		OC.addScript('files_texteditor','aceeditor/mode-'+filetype[ext], function(){
			var SyntaxMode = require("ace/mode/"+filetype[ext]).Mode;
			window.aceEditor.getSession().setMode(new SyntaxMode());
		});
	}	
}

function showControlBar(filename){
	// Loads the control bar at the top.
	$('.actions,#file_action_panel').fadeOut('slow').promise().done(function() {
		// Load the new toolbar.
		var html = '<div id="editorbar"><input type="button" id="editor_save" value="'+t('files_texteditor','Save')+'"><input type="button" id="editor_close" value="'+t('files_texteditor','Close Editor')+'"></div>';
		if($('#editorbar').length==0){
			$('#controls').append(html);
			$('#editorbar').fadeIn('slow');	
		}
		var breadcrumbhtml = '<div class="crumb svg" style="background-image:url(&quot;/core/img/breadcrumb.png&quot;)"><a href="#">'+filename+'</a></div>';
		$('.actions').before(breadcrumbhtml);
	});
}
 
function bindControlEvents(){
	$("#editor_save").live('click',function() {
		doFileSave();
	});	
	
	$('#editor_close').live('click',function() {
		hideFileEditor();	
	});
	
	$(document).bind('keydown', 'Ctrl+s', doFileSave);
}

function editorIsShown(){
	if($('#editor').length!=0){
		return true;
	} else {
		return false;	
	} 	
}

function updateSessionFileHash(path){
	$.get(OC.filePath('files_texteditor','ajax','loadfile.php'),
		{ path: path },
   		function(jsondata){
   			if(jsondata.status=='failure'){
   				alert('Failed to update session file hash.');	
   			}
   	}, "json");}

function doFileSave(){
	if(editorIsShown()){
	$('#editor_save').val(t('files_texteditor','Saving')+'...').css('background-color','#84E79F');
		var filecontents = window.aceEditor.getSession().getValue();
		var dir =  $('#editor').attr('data-dir');
		var file =  $('#editor').attr('data-filename');
		$.post(OC.filePath('files_texteditor','ajax','savefile.php'), { filecontents: filecontents, file: file, dir: dir },function(jsondata){
			
			if(jsondata.status == 'failure'){
				var answer = confirm(jsondata.data.message);
				if(answer){
					$.post(OC.filePath('files_texteditor','ajax','savefile.php'),{ filecontents: filecontents, file: file, dir: dir, force: 'true' },function(jsondata){
						if(jsondata.status =='success'){
							$('#editor_save').val(t('files_texteditor','Save'));
							$('#editor_save').effect("highlight", {color:'#4BFF8D'}, 3000);
						} 
						else {
							// Save error
							alert(jsondata.data.message);	
						}
					}, 'json');
				} 
		   		else {
					// Don't save!
					$('#editor_save').effect("highlight", {color:'#FF5757'}, 3000);
					$('#editor_save').val(t('files_texteditor','Save'));	
		   		}
			} 
			else if(jsondata.status == 'success'){
				// Success
				$('#editor_save').val(t('files_texteditor','Save'));
				$('#editor_save').effect("highlight", {color:'#4BFF8D'}, 3000);
			}
		}, 'json');
	giveEditorFocus();
	} else {
		return;	
	}	
};

function giveEditorFocus(){
	window.aceEditor.focus();
};

function showFileEditor(dir,filename){
	// Loads the file editor and display it.
	var data = $.ajax({
			url: OC.filePath('files','ajax','download.php')+'?files='+encodeURIComponent(filename)+'&dir='+encodeURIComponent(dir),
			complete: function(data){
				// Initialise the editor
				updateSessionFileHash(dir+'/'+filename);
				showControlBar(filename);
				$('table').fadeOut('slow', function() {
					$('#editor').text(data.responseText);
					// encodeURIComponenet?
					$('#editor').attr('data-dir', dir);
					$('#editor').attr('data-filename', filename);
					window.aceEditor = ace.edit("editor");  
					aceEditor.setShowPrintMargin(false);
					setSyntaxMode(getFileExtension(filename));
					OC.addScript('files_texteditor','aceeditor/theme-clouds', function(){
						window.aceEditor.setTheme("ace/theme/clouds");
					});
				});
			bindControlEvents();
			// End success
			}
			// End ajax
			});
	setEditorSize();
}

function hideFileEditor(){
	// Fade out controls
	$('#editorbar').fadeOut('slow');
	// Fade out breadcrumb
	$('.actions').prev().fadeOut('slow');
	// Fade out editor
	$('#editor').fadeOut('slow', function(){
		$('#editorbar').remove();
		$('#editor').remove();
		$('.actions').prev().remove();
		var editorhtml = '<div id="editor"></div>';
		$('table').after(editorhtml);
		$('.actions,#file_access_panel').fadeIn('slow');
		$('table').fadeIn('slow');	
	});
}

$(window).resize(function() {
  setEditorSize();
});