/**
* ownCloud
*
* @author Vincent Petry
* @copyright 2015 Vincent Petry <pvince81@owncloud.com>
*
* This library is free software; you can redistribute it and/or
* modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
* License as published by the Free Software Foundation; either
* version 3 of the License, or any later version.
*
* This library is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU AFFERO GENERAL PUBLIC LICENSE for more details.
*
* You should have received a copy of the GNU Affero General Public
* License along with this library.  If not, see <http://www.gnu.org/licenses/>.
*
*/

describe('OC.Settings.Apps tests', function() {
	var Apps;

	beforeEach(function() {
		var $el = $('<div id="apps-list"></div>' +
			'<div id="app-template">' +
			// dummy template for testing
			'<div id="app-{{id}}" data-id="{{id}}" class="section">{{name}}</div>' +
			'</div>'
		);
		$('#testArea').append($el);

		Apps = OC.Settings.Apps;
	});
	afterEach(function() {
		Apps.State.apps = null;
		Apps.State.currentCategory = null;
	});

	describe('Filtering apps', function() {
		var oldApps;

		function loadApps(appList) {
			Apps.State.apps = appList;

			_.each(appList, function(appSpec) {
				Apps.renderApp(appSpec);
			});
		}

		function getResultsFromDom() {
			var results = [];
			$('#apps-list .section:not(.hidden)').each(function() {
				results.push($(this).attr('data-id'));
			});
			return results;
		}

		beforeEach(function() {
			loadApps([
				{id: 'appone', name: 'App One', description: 'The first app'},
				{id: 'apptwo', name: 'App Two', description: 'The second app'},
				{id: 'appthree', name: 'App Three', description: 'Third app'},
				{id: 'somestuff', name: 'Some Stuff', description: 'whatever'}
			]);
		});

		it('does not filter when no query passed', function() {
			Apps.filter('');
			expect(getResultsFromDom().length).toEqual(4);
		});
		it('returns no results when query does not match anything', function() {
			Apps.filter('absurdity');
			expect(getResultsFromDom().length).toEqual(0);
		});
		it('returns relevant results when query matches name', function() {
			var results;
			Apps.filter('app');
			results = getResultsFromDom();
			expect(results.length).toEqual(3);
			expect(results[0]).toEqual('appone');
			expect(results[1]).toEqual('apptwo');
			expect(results[2]).toEqual('appthree');
		});
		it('returns relevant result when query matches name', function() {
			var results;
			Apps.filter('TWO');
			results = getResultsFromDom();
			expect(results.length).toEqual(1);
			expect(results[0]).toEqual('apptwo');
		});
		it('returns relevant result when query matches description', function() {
			var results;
			Apps.filter('ever');
			results = getResultsFromDom();
			expect(results.length).toEqual(1);
			expect(results[0]).toEqual('somestuff');
		});
	});
});
