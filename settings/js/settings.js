/**
 * Copyright (c) 2014, Vincent Petry <pvince81@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or later.
 * See the COPYING-README file.
 */
OC.Settings = OC.Settings || {};
OC.Settings = _.extend(OC.Settings, {
	/**
	 * Setup selection box for group selection.
	 * @param $elements jQuery element (hidden input) to setup select2 on
	 * @param [extraOptions] extra options hash to pass to select2
	 */
	setupGroupsSelect: function($elements, extraOptions) {
		if ($elements.length > 0) {
			// note: settings are saved through a "change" event registered
			// on all input fields
			$elements.select2(_.extend({
				placeholder: t('core', 'Groups'),
				allowClear: true,
				multiple: true,
				ajax: {
					url: OC.generateUrl('/settings/ajax/grouplist'),
					dataType: 'json',
					quietMillis: 100,
					data: function (term) {
						return {
							pattern: term, //search term
						};
					},
					results: function (data) {
						if (data.status === "success") {
							var results = [];

							// add groups
							$.each(data.data.adminGroups, function(i, group) {
								results.push({id:group.id, displayname:group.name});
							});
							$.each(data.data.groups, function(i, group) {
								results.push({id:group.id, displayname:group.name});
							});

							return {results: results};
						} else {
							//FIXME add error handling
						}
					}
				},
				id: function(element) {
					return element.id;
				},
				initSelection: function(element, callback) {
					var selection =
						_.map(($(element).val() || []).split(',').sort(),
							function(groupName) {
						return {
							id: groupName,
							displayname: groupName
						};
					});
					callback(selection);
				},
				formatResult: function (element) {
					return element.displayname;
				},
				formatSelection: function (element) {
					return element.displayname;
				}
			}, extraOptions || {}));
		}
	}
});

