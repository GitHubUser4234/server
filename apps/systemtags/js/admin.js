(function() {
	if (!OCA.SystemTags) {
		/**
		 * @namespace
		 */
		OCA.SystemTags = {};
	}

	OCA.SystemTags.Admin = {

		collection: null,

		init: function() {
			var self = this;

			this.collection = new OC.SystemTags.SystemTagsCollection();
			this.collection.fetch({
				success: function() {
					$('#systemtag').select2(_.extend(self.select2));
				}
			});

			$('#systemtag_submit').on('click', _.bind(this._onClickSubmit, this));
			$('#systemtag_delete').on('click', _.bind(this._onClickDelete, this));
			$('#systemtag_reset').on('click', _.bind(this._onClickReset, this));
		},

		/**
		 * Selecting a systemtag in select2
		 *
		 * @param {OC.SystemTags.SystemTagModel} tag
		 */
		onSelectTag: function (tag) {
			var level = 0;
			if (tag.get('userVisible')) {
				level += 2;
				if (tag.get('userAssignable')) {
					level += 1;
				}
			}

			$('#systemtag_name').val(tag.get('name'));
			$('#systemtag_level').val(level);

			this._prepareForm(tag.get('id'));
		},

		/**
		 * Clicking the "Create"/"Update" button
		 */
		_onClickSubmit: function () {
			var level = parseInt($('#systemtag_level').val(), 10),
				tagId = $('#systemtags_manager').attr('data-systemtag-id');
			var data = {
				name: $('#systemtag_name').val(),
				userVisible: level === 2 || level === 3,
				userAssignable: level === 3
			};

			if (tagId) {
				var model = this.collection.get(tagId);
				model.save(data);
			} else {
				this.collection.create(data);
			}

			this._onClickReset();
		},

		/**
		 * Clicking the "Delete" button
		 */
		_onClickDelete: function () {
			var tagId = $('#systemtags_manager').attr('data-systemtag-id');
			var model = this.collection.get(tagId);
			model.destroy();

			this._onClickReset();
		},

		/**
		 * Clicking the "Reset" button
		 */
		_onClickReset: function () {
			$('#systemtag_name').val('');
			$('#systemtag_level').val(3);
			this._prepareForm(0);
		},

		/**
		 * Prepare the form for create/update
		 *
		 * @param {int} tagId
		 */
		_prepareForm: function (tagId) {
			if (tagId > 0) {
				$('#systemtags_manager').attr('data-systemtag-id', tagId);
				$('#systemtag_delete').removeClass('hidden');
				$('#systemtag_submit').val(t('systemtags_manager', 'Update'));
			} else {
				$('#systemtag').select2('val', '');
				$('#systemtags_manager').attr('data-systemtag-id', '');
				$('#systemtag_delete').addClass('hidden');
				$('#systemtag_submit').val(t('systemtags_manager', 'Create'));
			}
		},

		/**
		 * Select2 options for the SystemTag dropdown
		 */
		select2: {
			allowClear: false,
			multiple: false,
			placeholder: t('systemtags_manager', 'Select tag…'),
			query: _.debounce(function(query) {
				query.callback({
					results: OCA.SystemTags.Admin.collection.filterByName(query.term)
				});
			}, 100, true),
			id: function(element) {
				return element;
			},
			initSelection: function(element, callback) {
				var selection = ($(element).val() || []).split('|').sort();
				callback(selection);
			},
			formatResult: function (tag) {
				console.log('formatResult');
				return OC.SystemTags.getDescriptiveTag(tag);
			},
			formatSelection: function (tag) {
				OCA.SystemTags.Admin.onSelectTag(tag);
				return OC.SystemTags.getDescriptiveTag(tag);
			},
			escapeMarkup: function(m) {
				console.log('escapeMarkup');
				return m;
			}
		}
	};
})();

$(document).ready(function() {
	OCA.SystemTags.Admin.init();
});

