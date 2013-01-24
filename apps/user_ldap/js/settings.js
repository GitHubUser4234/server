var LdapConfiguration = {
	refreshConfig: function() {
		$.post(
			OC.filePath('user_ldap','ajax','getConfiguration.php'),
			$('#ldap_serverconfig_chooser').serialize(),
			function (result) {
				if(result.status == 'success') {
					$.each(result.configuration, function(configkey, configvalue) {
						elementID = '#'+configkey;

						//deal with Checkboxes
						if($(elementID).is('input[type=checkbox]')) {
							if(configvalue == 1) {
								$(elementID).attr('checked', 'checked');
							} else {
								$(elementID).removeAttr('checked');
							}
							return;
						}

						//On Textareas, Multi-Line Settings come as array
						if($(elementID).is('textarea') && $.isArray(configvalue)) {
							configvalue = configvalue.join("\n");
						}

						// assign the value
						$('#'+configkey).val(configvalue);
					});
				}
			}
		);
	},

	resetDefaults: function() {
		$('#ldap').find('input[type=text], input[type=number], input[type=password], textarea, select').each(function() {
			if($(this).attr('id') == 'ldap_serverconfig_chooser') {
				return;
			}
			$(this).val($(this).attr('data-default'));
		});
		$('#ldap').find('input[type=checkbox]').each(function() {
			if($(this).attr('data-default') == 1) {
				$(this).attr('checked', 'checked');
			} else {
				$(this).removeAttr('checked');
			}
		});
	},

	deleteConfiguration: function() {
		$.post(
			OC.filePath('user_ldap','ajax','deleteConfiguration.php'),
			$('#ldap_serverconfig_chooser').serialize(),
			function (result) {
				if(result.status == 'success') {
					$('#ldap_serverconfig_chooser option:selected').remove();
					$('#ldap_serverconfig_chooser option:first').select();
					LdapConfiguration.refreshConfig();
				} else {
					OC.dialogs.alert(
						result.message,
						'Deletion failed'
					);
				}
			}
		);
	}
}

$(document).ready(function() {
	$('#ldapSettings').tabs();
	$('#ldap_action_test_connection').button();
	$('#ldap_action_delete_configuration').button();
	LdapConfiguration.refreshConfig();
	$('#ldap_action_test_connection').click(function(event){
		event.preventDefault();
		$.post(
			OC.filePath('user_ldap','ajax','testConfiguration.php'),
			$('#ldap').serialize(),
			function (result) {
				if (result.status == 'success') {
					OC.dialogs.alert(
						result.message,
						'Connection test succeeded'
					);
				} else {
					OC.dialogs.alert(
						result.message,
						'Connection test failed'
					);
				}
			}
		);
	});

	$('#ldap_action_delete_configuration').click(function(event) {
		event.preventDefault();
		OC.dialogs.confirm(
			'Do you really want to delete the current Server Configuration?',
			'Confirm Deletion',
			function(deleteConfiguration) {
				if(deleteConfiguration) {
					LdapConfiguration.deleteConfiguration();
				}
			}
		);
	});

	$('#ldap_submit').click(function(event) {
		event.preventDefault();
		$.post(
			OC.filePath('user_ldap','ajax','setConfiguration.php'),
			$('#ldap').serialize(),
			function (result) {
				if (result.status == 'success') {
					$('#notification').text(t('user_ldap', 'LDAP Configuration Saved'));
					$('#notification').fadeIn();
				}
			}
		);
	});

	$('#ldap_serverconfig_chooser').change(function(event) {
		value = $('#ldap_serverconfig_chooser option:selected:first').attr('value');
		if(value == 'NEW') {
			$.post(
				OC.filePath('user_ldap','ajax','getNewServerConfigPrefix.php'),
				function (result) {
					if(result.status == 'success') {
						OC.dialogs.confirm(
							'Take over settings from recent server configuration?',
							'Keep settings?',
							function(keep) {
								if(!keep) {
									LdapConfiguration.resetDefaults();
								}
							}
						);
						$('#ldap_serverconfig_chooser option:selected').removeAttr('selected');
						var html = '<option value="'+result.configPrefix+'" selected="selected">'+$('#ldap_serverconfig_chooser option').length+'. Server</option>';
						$('#ldap_serverconfig_chooser option:last').before(html);
					} else {
						OC.dialogs.alert(
							result.message,
							'Cannot add server configuration'
						);
					}
				}
			);
		} else {
			LdapConfiguration.refreshConfig();
		}
	});
});