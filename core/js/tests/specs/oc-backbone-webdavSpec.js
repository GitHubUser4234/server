/**
* ownCloud
*
* @author Vincent Petry
* @copyright 2014 Vincent Petry <pvince81@owncloud.com>
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

/* global dav */

describe('Backbone Webdav extension', function() {
	var davClientRequestStub;
	var davClientPropPatchStub;
	var davClientPropFindStub;
	var deferredRequest;

	beforeEach(function() {
		deferredRequest = $.Deferred();
		davClientRequestStub = sinon.stub(dav.Client.prototype, 'request');
		davClientPropPatchStub = sinon.stub(dav.Client.prototype, 'propPatch');
		davClientPropFindStub = sinon.stub(dav.Client.prototype, 'propFind');
		davClientRequestStub.returns(deferredRequest.promise());
		davClientPropPatchStub.returns(deferredRequest.promise());
		davClientPropFindStub.returns(deferredRequest.promise());
	});
	afterEach(function() {
		davClientRequestStub.restore();
		davClientPropPatchStub.restore();
		davClientPropFindStub.restore();
	});

	describe('collections', function() {
		var TestModel;
		var TestCollection;
		beforeEach(function() {
			TestModel = OC.Backbone.Model.extend({
				sync: OC.Backbone.davSync,
				davProperties: {
					'firstName': '{http://owncloud.org/ns}first-name',
					'lastName': '{http://owncloud.org/ns}last-name',
				}
			});
			TestCollection = OC.Backbone.Collection.extend({
				sync: OC.Backbone.davSync,
				model: TestModel,
				url: 'http://example.com/owncloud/remote.php/test/'
			});
		});

		it('makes a POST request to create model into collection', function() {
			var collection = new TestCollection();
			var model = collection.create({
				firstName: 'Hello',
				lastName: 'World'
			});

			expect(davClientRequestStub.calledOnce).toEqual(true);
			expect(davClientRequestStub.getCall(0).args[0])
				.toEqual('POST');
			expect(davClientRequestStub.getCall(0).args[1])
				.toEqual('http://example.com/owncloud/remote.php/test/');
			expect(davClientRequestStub.getCall(0).args[2]['Content-Type'])
				.toEqual('application/json');
			expect(davClientRequestStub.getCall(0).args[2]['X-Requested-With'])
				.toEqual('XMLHttpRequest');
			expect(davClientRequestStub.getCall(0).args[3])
				.toEqual(JSON.stringify({
					'firstName': 'Hello',
					'lastName': 'World'
				}));

			var responseHeaderStub = sinon.stub()
				.withArgs('Content-Location')
				.returns('http://example.com/owncloud/remote.php/test/123');
			deferredRequest.resolve({
				status: 201,
				body: '',
				xhr: {
					getResponseHeader: responseHeaderStub
				}
			});

			expect(model.id).toEqual('123');
		});

		it('uses PROPFIND to retrieve collection', function() {
			var successStub = sinon.stub();
			var errorStub = sinon.stub();
			var collection = new TestCollection();
			collection.fetch({
				success: successStub,
				error: errorStub
			});

			expect(davClientPropFindStub.calledOnce).toEqual(true);
			expect(davClientPropFindStub.getCall(0).args[0])
				.toEqual('http://example.com/owncloud/remote.php/test/');
			expect(davClientPropFindStub.getCall(0).args[1])
				.toEqual([
					'{http://owncloud.org/ns}first-name',
					'{http://owncloud.org/ns}last-name'
				]);
			expect(davClientPropFindStub.getCall(0).args[2])
				.toEqual(1);
			expect(davClientPropFindStub.getCall(0).args[3]['X-Requested-With'])
				.toEqual('XMLHttpRequest');

			deferredRequest.resolve({
				status: 207,
				body: [
					// root element
					{
						href: 'http://example.org/owncloud/remote.php/test/',
						propStat: []
					},
					// first model
					{
						href: 'http://example.org/owncloud/remote.php/test/123',
						propStat: [{
							status: 'HTTP/1.1 200 OK',
							properties: {
								'{http://owncloud.org/ns}first-name': 'Hello',
								'{http://owncloud.org/ns}last-name': 'World'
							}
						}]
					},
					// second model
					{
						href: 'http://example.org/owncloud/remote.php/test/456',
						propStat: [{
							status: 'HTTP/1.1 200 OK',
							properties: {
								'{http://owncloud.org/ns}first-name': 'Test',
								'{http://owncloud.org/ns}last-name': 'Person'
							}
						}]
					}
				]
			});

			expect(collection.length).toEqual(2);

			var model = collection.get('123');
			expect(model.id).toEqual('123');
			expect(model.get('firstName')).toEqual('Hello');
			expect(model.get('lastName')).toEqual('World');

			model = collection.get('456');
			expect(model.id).toEqual('456');
			expect(model.get('firstName')).toEqual('Test');
			expect(model.get('lastName')).toEqual('Person');

			expect(successStub.calledOnce).toEqual(true);
			expect(errorStub.notCalled).toEqual(true);
		});

		function testMethodError(doCall) {
			var successStub = sinon.stub();
			var errorStub = sinon.stub();

			doCall(successStub, errorStub);

			deferredRequest.resolve({
				status: 404,
				body: ''
			});

			expect(successStub.notCalled).toEqual(true);
			expect(errorStub.calledOnce).toEqual(true);
		}

		it('calls error handler if error status in PROPFIND response', function() {
			testMethodError(function(success, error) {
				var collection = new TestCollection();
				collection.fetch({
					success: success,
					error: error
				});
			});
		});
		it('calls error handler if error status in POST response', function() {
			testMethodError(function(success, error) {
				var collection = new TestCollection();
				collection.create({
					firstName: 'Hello',
					lastName: 'World'
				}, {
					success: success,
					error: error
				});
			});
		});
	});
	describe('models', function() {
		var TestModel;
		beforeEach(function() {
			TestModel = OC.Backbone.Model.extend({
				sync: OC.Backbone.davSync,
				davProperties: {
					'firstName': '{http://owncloud.org/ns}first-name',
					'lastName': '{http://owncloud.org/ns}last-name',
				},
				url: function() {
					return 'http://example.com/owncloud/remote.php/test/' + this.id;
				}
			});
		});

		it('makes a PROPPATCH request to update model', function() {
			var model = new TestModel({
				id: '123',
				firstName: 'Hello',
				lastName: 'World'
			});

			model.save({
				firstName: 'Hey'
			});

			expect(davClientPropPatchStub.calledOnce).toEqual(true);
			expect(davClientPropPatchStub.getCall(0).args[0])
				.toEqual('http://example.com/owncloud/remote.php/test/123');
			expect(davClientPropPatchStub.getCall(0).args[1])
				.toEqual({
					'{http://owncloud.org/ns}first-name': 'Hey'
				});
			expect(davClientPropPatchStub.getCall(0).args[2]['X-Requested-With'])
				.toEqual('XMLHttpRequest');

			deferredRequest.resolve({
				status: 201,
				body: ''
			});

			expect(model.id).toEqual('123');
			expect(model.get('firstName')).toEqual('Hey');
		});

		it('uses PROPFIND to fetch single model', function() {
			var model = new TestModel({
				id: '123'
			});

			model.fetch();

			expect(davClientPropFindStub.calledOnce).toEqual(true);
			expect(davClientPropFindStub.getCall(0).args[0])
				.toEqual('http://example.com/owncloud/remote.php/test/123');
			expect(davClientPropFindStub.getCall(0).args[1])
				.toEqual([
					'{http://owncloud.org/ns}first-name',
					'{http://owncloud.org/ns}last-name'
				]);
			expect(davClientPropFindStub.getCall(0).args[2])
				.toEqual(0);
			expect(davClientPropFindStub.getCall(0).args[3]['X-Requested-With'])
				.toEqual('XMLHttpRequest');

			deferredRequest.resolve({
				status: 207,
				body: {
					href: 'http://example.org/owncloud/remote.php/test/123',
					propStat: [{
						status: 'HTTP/1.1 200 OK',
						properties: {
							'{http://owncloud.org/ns}first-name': 'Hello',
							'{http://owncloud.org/ns}last-name': 'World'
						}
					}]
				}
			});

			expect(model.id).toEqual('123');
			expect(model.get('firstName')).toEqual('Hello');
			expect(model.get('lastName')).toEqual('World');
		});
		it('makes a DELETE request to destroy model', function() {
			var model = new TestModel({
				id: '123',
				firstName: 'Hello',
				lastName: 'World'
			});

			model.destroy();

			expect(davClientRequestStub.calledOnce).toEqual(true);
			expect(davClientRequestStub.getCall(0).args[0])
				.toEqual('DELETE');
			expect(davClientRequestStub.getCall(0).args[1])
				.toEqual('http://example.com/owncloud/remote.php/test/123');
			expect(davClientRequestStub.getCall(0).args[2]['X-Requested-With'])
				.toEqual('XMLHttpRequest');
			expect(davClientRequestStub.getCall(0).args[3])
				.toBeFalsy();

			deferredRequest.resolve({
				status: 200,
				body: ''
			});
		});

		function testMethodError(doCall) {
			var successStub = sinon.stub();
			var errorStub = sinon.stub();

			doCall(successStub, errorStub);

			deferredRequest.resolve({
				status: 404,
				body: ''
			});

			expect(successStub.notCalled).toEqual(true);
			expect(errorStub.calledOnce).toEqual(true);
		}

		it('calls error handler if error status in PROPFIND response', function() {
			testMethodError(function(success, error) {
				var model = new TestModel();
				model.fetch({
					success: success,
					error: error
				});
			});
		});
		it('calls error handler if error status in PROPPATCH response', function() {
			testMethodError(function(success, error) {
				var model = new TestModel();
				model.save({
					firstName: 'Hey'
				}, {
					success: success,
					error: error
				});
			});
		});
	});
});

