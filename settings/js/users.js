/**
 * Copyright (c) 2011, Robin Appelman <icewind1991@gmail.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */

UserList={
	useUndo:true,
	
	/**
	 * @brief Initiate user deletion process in UI
	 * @param string uid the user ID to be deleted
	 *
	 * Does not actually delete the user; it sets them for
	 * deletion when the current page is unloaded, at which point 
	 * finishDelete() completes the process. This allows for 'undo'.
	 */
	do_delete:function( uid ) {
		
		UserList.deleteUid = uid;
		
		// Set undo flag
		UserList.deleteCanceled = false;
		
		// Hide user in table to reflect deletion
		$(this).parent().parent().hide();
		$('tr').filterAttr( 'data-uid', UserList.deleteUid ).hide();
		
		// Provide user with option to undo
		$('#notification').text(t('files','undo delete user'));
		$('#notification').data('deleteuser',true);
		$('#notification').fadeIn();
			
	},
	
	/**
	 * @brief Delete a user via ajax
	 * @param bool ready whether to use ready() upon completion
	 *
	 * Executes deletion via ajax of user identified by property deleteUid 
	 * if 'undo' has not been used.  Completes the user deletion procedure 
	 * and reflects success in UI.
	 */
	finishDelete:function( ready ){
		
		// Check deletion has not been undone
		if( !UserList.deleteCanceled && UserList.deleteUid ){
			
			// Delete user via ajax
			$.post(
				OC.filePath('settings','ajax','removeuser.php'),
				{username:UserList.deleteUid},
				function(result){
					
					// Remove undo option, & remove user from table
					boolOperationFinished( 
						data, function(){
							$('#notification').fadeOut();
							$('tr').filterAttr( 'data-uid', username ).remove();
							UserList.deleteCanceled=true;
							UserList.deleteFiles=null;
							if( ready ){
								ready();
							}
						}
					);
				}
			);
 		}
	}
}

$(document).ready(function(){
	function setQuota(uid,quota,ready){
		$.post(
			OC.filePath('settings','ajax','setquota.php'),
			{username:uid,quota:quota},
			function(result){
				if(ready){
					ready(result.data.quota);
				}
			}
		);
	}
	
	function applyMultiplySelect(element){
		console.log(element);
		var checked=[];
		var user=element.data('username');
		if($(element).attr('class') == 'groupsselect'){		
			if(element.data('userGroups')){
				checked=element.data('userGroups').split(', ');
			}
			if(user){
				var checkHandeler=function(group){
					if(user==OC.currentUser && group=='admin'){
						return false;
					}
					$.post(
						OC.filePath('settings','ajax','togglegroups.php'),
						{
							username:user,
							group:group
						},
						function(){}
					);
				};
			}else{
				checkHandeler=false;
			}
			var addGroup = function(group) {
				$('select[multiple]').each(function(index, element) {
					if ($(element).find('option[value="'+group +'"]').length == 0) {
						$(element).append('<option value="'+group+'">'+group+'</option>');
					}
				})
			};
			element.multiSelect({
				createCallback:addGroup,
				createText:'add group',
				checked:checked,
				oncheck:checkHandeler,
				onuncheck:checkHandeler,
				minWidth: 100,
			});
		}
		if($(element).attr('class') == 'subadminsselect'){	
			if(element.data('subadmin')){
				checked=element.data('subadmin').split(', ');
			}
			var checkHandeler=function(group){
				if(group=='admin'){
					return false;
				}
				$.post(
					OC.filePath('settings','ajax','togglesubadmins.php'),
					{
						username:user,
						group:group
					},
					function(){}
				);
			};
			
			var addSubAdmin = function(group) {
				console.log('addSubAdmin called');
				console.log(group);
				$('select[multiple]').each(function(index, element) {
					if ($(element).find('option[value="'+group +'"]').length == 0) {
						$(element).append('<option value="'+group+'">'+group+'</option>');
					}
				})
			};
			element.multiSelect({
				createCallback:addSubAdmin,
				createText:null,
				checked:checked,
				oncheck:checkHandeler,
				onuncheck:checkHandeler,
				minWidth: 100,
			});
		}
	}
	$('select[multiple]').each(function(index,element){
		applyMultiplySelect($(element));
	});
	
	$('td.remove>img').live('click',function(event){
		
		var uid = $(this).parent().parent().data('uid');
		
		// Call function for handling delete/undo
		UserList.do_delete( uid );
		
	});
	
	$('td.password>img').live('click',function(event){
		event.stopPropagation();
		var img=$(this);
		var uid=img.parent().parent().data('uid');
		var input=$('<input type="password">');
		img.css('display','none');
		img.parent().children('span').replaceWith(input);
		input.focus();
		input.keypress(function(event) {
			if(event.keyCode == 13) {
				if($(this).val().length>0){
					$.post(
						OC.filePath('settings','ajax','changepassword.php'),
						{username:uid,password:$(this).val()},
						function(result){}
					);
					input.blur();
				}else{
					input.blur();
				}
			}
		});
		input.blur(function(){
			$(this).replaceWith($('<span>●●●●●●●</span>'));
			img.css('display','');
		});
	});
	$('td.password').live('click',function(event){
		$(this).children('img').click();
	});
	
	$('select.quota, select.quota-user').live('change',function(){
		var select=$(this);
		var uid=$(this).parent().parent().parent().data('uid');
		var quota=$(this).val();
		var other=$(this).next();
		if(quota!='other'){
			other.hide();
			select.data('previous',quota);
			setQuota(uid,quota);
		}else{
			other.show();
			select.addClass('active');
			other.focus();
		}
	});
	$('select.quota, select.quota-user').each(function(i,select){
		$(select).data('previous',$(select).val());
	})
	
	$('input.quota-other').live('change',function(){
		var uid=$(this).parent().parent().data('uid');
		var quota=$(this).val();
		var select=$(this).prev();
		var other=$(this);
		if(quota){
			setQuota(uid,quota,function(quota){
				select.children().attr('selected',null);
				var existingOption=select.children().filter(function(i,option){
					return ($(option).val()==quota);
				});
				if(existingOption.length){
					existingOption.attr('selected','selected');
				}else{
					var option=$('<option/>');
					option.attr('selected','selected').attr('value',quota).text(quota);
					select.children().last().before(option);
				}
				select.val(quota);
				select.removeClass('active');
				other.val(null);
				other.hide();
			});
		}else{
			var previous=select.data('previous');
			select.children().attr('selected',null);
			select.children().each(function(i,option){
				if($(option).val()==previous){
					$(option).attr('selected','selected');
				}
			});
			select.removeClass('active');
			other.hide();
		}
	});
	
	$('input.quota-other').live('blur',function(){
		$(this).change();
	})
	
	$('#newuser').submit(function(event){
		event.preventDefault();
		var username=$('#newusername').val();
		var password=$('#newuserpassword').val();
		if($('#content table tbody tr').filterAttr('data-uid',username).length>0){
			OC.dialogs.alert('The username is already being used', 'Error creating user');
			return;
		}
		if($.trim(username) == '') {
			OC.dialogs.alert('A valid username must be provided', 'Error creating user');
			return false;
		}
		if($.trim(password) == '') {
			OC.dialogs.alert('A valid password must be provided', 'Error creating user');
			return false;
		}
		var groups=$('#newusergroups').prev().children('div').data('settings').checked;
		$('#newuser').get(0).reset();
		$.post(
			OC.filePath('settings','ajax','createuser.php'),
			{
				username:username,
				password:password,
				groups:groups,
			},
			function(result){
				if(result.status!='success'){
					OC.dialogs.alert(result.data.message, 'Error creating user');
				}
				else {
					groups = result.data.groups;
					console.log(groups);
					var tr=$('#content table tbody tr').first().clone();
					tr.attr('data-uid',username);
					tr.find('td.name').text(username);
					var select=$('<select multiple="multiple" class="groupsselect" data-placehoder="Groups" title="Groups">');
					select.data('username',username);
					select.data('userGroups',groups);
					tr.find('td.groups').empty();
					var allGroups=$('#content table').data('groups').split(', ');
					for(var i=0;i<groups.length;i++){
						if(allGroups.indexOf(groups[i])==-1){
							allGroups.push(groups[i]);
						}
					}
					$.each(allGroups,function(i,group){
						select.append($('<option value="'+group+'">'+group+'</option>'));
					});
					tr.find('td.groups').append(select);
					if(tr.find('td.remove img').length==0){
						tr.find('td.remove').append($('<img alt="Delete" title="'+t('settings','Delete')+'" class="svg action" src="'+OC.imagePath('core','actions/delete')+'"/>'));
					}
					applyMultiplySelect(select);
					$('#content table tbody').last().append(tr);

					tr.find('select.quota-user option').attr('selected',null);
					tr.find('select.quota-user option').first().attr('selected','selected');
					tr.find('select.quota-user').data('previous','default');
				}
			}
		);
	});
	// Handle undo notifications
	$('#notification').hide();
	$('#notification').click(function(){
		if($('#notification').data('deleteuser'))
		{
			$( 'tr' ).filterAttr( 'data-uid', UserList.deleteUid ).show();
			UserList.deleteCanceled=true;
			UserList.deleteFiles=null;
		}
		$('#notification').fadeOut();
	});
	UserList.useUndo=('onbeforeunload' in window)
	$(window).bind('beforeunload', function (){
		UserList.finishDelete(null);
	});
});
