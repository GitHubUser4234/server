/**
 * Copyright (c) 2011, Robin Appelman <icewind1991@gmail.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */


$(document).ready(function(){
	// Trigger ajax on filetype blacklist change
	$('#encryption_blacklist').multiSelect({
		oncheck:blackListChange,
		onuncheck:blackListChange,
		createText:'...'
	});
	
	// Trigger ajax on recoveryAdmin status change
	$( 'input:radio[name="adminEnableRecovery"]' ).change( 
		function() {
			
			var foo = $( this ).val();
			
			$.post( 
				OC.filePath('files_encryption', 'ajax', 'adminrecovery.php')
				, { adminEnableRecovery: foo, recoveryPassword: 'password' }
				,  function( data ) {
					alert( data );
				}
			);
		}
	);
	
	function blackListChange(){
		var blackList=$('#encryption_blacklist').val().join(',');
		OC.AppConfig.setValue('files_encryption','type_blacklist',blackList);
	}
})