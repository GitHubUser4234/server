/**
 * Copyright (c) 2016 ownCloud Inc
 *
 * @author Lukas Reschke <lukas@owncloud.com>
 *
 * This file is licensed under the Affero General Public License version 3
 * or later.
 *
 * See the COPYING-README file.
 *
 */

/**
 * Creates a new authentication token and loads the updater URL
 */
var loginToken = '';
$(document).ready(function(){
	$('#oca_updatenotification_button').click(function() {
		// Load the new token
		$.ajax({
			url: OC.generateUrl('/apps/updatenotification/credentials')
		}).success(function(data) {
			loginToken = data;
			$.ajax({
				url: OC.webroot+'/updater/',
				headers: {
					'Authorization': loginToken
				},
				method: 'POST',
				success: function(data){
					if(data !== 'false') {
						var body = $('body');
						$('head').remove();
						body.html(data);
						body.removeAttr('id');
						body.attr('id', 'body-settings');
					}
				}
			});
		});
	});
	$('#release-channel').change(function() {
		var newChannel = $('#release-channel').find(":selected").val();
		$.post(
			OC.generateUrl('/apps/updatenotification/channel'),
			{
				'channel': newChannel
			},
			function(data){
				OC.msg.finishedAction('#channel_save_msg', data);
			}
		);
	});
});
