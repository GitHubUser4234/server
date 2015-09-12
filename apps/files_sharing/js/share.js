/*
 * Copyright (c) 2014
 *
 * This file is licensed under the Affero General Public License version 3
 * or later.
 *
 * See the COPYING-README file.
 *
 */

(function() {
	if (!OCA.Sharing) {
		OCA.Sharing = {};
	}
	/**
	 * @namespace
	 */
	OCA.Sharing.Util = {
		/**
		 * Initialize the sharing plugin.
		 *
		 * Registers the "Share" file action and adds additional
		 * DOM attributes for the sharing file info.
		 *
		 * @param {OCA.Files.FileList} fileList file list to be extended
		 */
		attach: function(fileList) {
			// core sharing is disabled/not loaded
			if (!OC.Share) {
				return;
			}
			if (fileList.id === 'trashbin' || fileList.id === 'files.public') {
				return;
			}
			var oldCreateRow = fileList._createRow;
			fileList._createRow = function(fileData) {
				var tr = oldCreateRow.apply(this, arguments);
				var sharePermissions = fileData.permissions;
				if (fileData.mountType && fileData.mountType === "external-root"){
					// for external storages we cant use the permissions of the mountpoint
					// instead we show all permissions and only use the share permissions from the mountpoint to handle resharing
					sharePermissions = sharePermissions | (OC.PERMISSION_ALL & ~OC.PERMISSION_SHARE);
				}
				if (fileData.type === 'file') {
					// files can't be shared with delete permissions
					sharePermissions = sharePermissions & ~OC.PERMISSION_DELETE;
				}
				tr.attr('data-share-permissions', sharePermissions);
				if (fileData.shareOwner) {
					tr.attr('data-share-owner', fileData.shareOwner);
					// user should always be able to rename a mount point
					if (fileData.isShareMountPoint) {
						tr.attr('data-permissions', fileData.permissions | OC.PERMISSION_UPDATE);
					}
				}
				if (fileData.recipientsDisplayName) {
					tr.attr('data-share-recipients', fileData.recipientsDisplayName);
				}
				return tr;
			};

			var oldElementToFile = fileList.elementToFile;
			fileList.elementToFile = function($el) {
				var fileInfo = oldElementToFile.apply(this, arguments);
				fileInfo.sharePermissions = $el.attr('data-share-permissions') || undefined;
				fileInfo.shareOwner = $el.attr('data-share-owner') || undefined;
				return fileInfo;
			};

			// use delegate to catch the case with multiple file lists
			fileList.$el.on('fileActionsReady', function(ev){
				var fileList = ev.fileList;
				var $files = ev.$files;

				function updateIcons($files) {
					if (!$files) {
						// if none specified, update all
						$files = fileList.$fileList.find('tr');
					}
					_.each($files, function(file) {
						OCA.Sharing.Util.updateFileActionIcon($(file));
					});
				}

				if (!OCA.Sharing.sharesLoaded){
					OC.Share.loadIcons('file', fileList, function() {
						// since we don't know which files are affected, just refresh them all
						updateIcons();
					});
					// assume that we got all shares, so switching directories
					// will not invalidate that list
					OCA.Sharing.sharesLoaded = true;
				}
				else{
					updateIcons($files);
				}
			});

			fileList.registerTabView(new OCA.Sharing.ShareTabView('shareTabView'));
		},

		/**
		 * Update the file action share icon for the given file
		 *
		 * @param $tr file element of the file to update
		 */
		updateFileActionIcon: function($tr) {
			// if the statuses are loaded already, use them for the icon
			// (needed when scrolling to the next page)
			var shareStatus = OC.Share.statuses[$tr.data('id')];
			if (shareStatus || $tr.attr('data-share-recipients') || $tr.attr('data-share-owner')) {
				var permissions = $tr.data('permissions');
				var hasLink = !!(shareStatus && shareStatus.link);
				OC.Share.markFileAsShared($tr, true, hasLink);
				if ((permissions & OC.PERMISSION_SHARE) === 0 && $tr.attr('data-share-owner')) {
					// if no share action exists because the admin disabled sharing for this user
					// we create a share notification action to inform the user about files
					// shared with him otherwise we just update the existing share action.
					// TODO: make this work like/with OC.Share.markFileAsShared()
					$tr.find('.fileactions .action-share-notification').remove();
					var shareNotification = '<a class="action action-share-notification permanent"' +
							' data-action="Share-Notification" href="#" original-title="">' +
							' <img class="svg" src="' + OC.imagePath('core', 'actions/share') + '"></img>';
					$tr.find('.fileactions').append(function() {
						var shareBy = escapeHTML($tr.attr('data-share-owner'));
						var $result = $(shareNotification + '<span> ' + shareBy + '</span></span>');
						$result.on('click', function() {
							return false;
						});
						return $result;
					});
				}
			}
		},

		/**
		 * Formats a recipients array to be displayed.
		 * The first four recipients will be shown and the
		 * other ones will be shown as "+x" where "x" is the number of
		 * remaining recipients.
		 *
		 * @param {Array.<String>} recipients recipients array
		 * @param {int} count optional total recipients count (in case the array was shortened)
		 * @return {String} formatted recipients display text
		 */
		formatRecipients: function(recipients, count) {
			var maxRecipients = 4;
			var text;
			if (!_.isNumber(count)) {
				count = recipients.length;
			}
			// TODO: use natural sort
			recipients = _.first(recipients, maxRecipients).sort();
			text = recipients.join(', ');
			if (count > maxRecipients) {
				text += ', +' + (count - maxRecipients);
			}
			return text;
		}
	};
})();

OC.Plugins.register('OCA.Files.FileList', OCA.Sharing.Util);

