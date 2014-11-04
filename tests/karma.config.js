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

/**
 * This node module is run by the karma executable to specify its configuration.
 *
 * The list of files from all needed JavaScript files including the ones from the
 * apps to test, and the test specs will be passed as configuration object.
 *
 * Note that it is possible to test a single app by setting the KARMA_TESTSUITE
 * environment variable to the apps name, for example "core" or "files_encryption".
 * Multiple apps can be specified by separating them with space.
 *
 * Setting the environment variable NOCOVERAGE to 1 will disable the coverage
 * preprocessor, which is needed to be able to debug tests properly in a browser.
 */

/* jshint node: true */
module.exports = function(config) {

	function findApps() {
		/*
		var fs = require('fs');
		var apps = fs.readdirSync('apps');
		return apps;
		*/
		// other apps tests don't run yet... needs further research / clean up
		return [
			'files',
			'files_trashbin',
			{
				name: 'files_sharing',
				srcFiles: [
					// only test these files, others are not ready and mess
					// up with the global namespace/classes/state
					'apps/files_sharing/js/app.js',
					'apps/files_sharing/js/sharedfilelist.js',
					'apps/files_sharing/js/share.js'
				],
				testFiles: ['apps/files_sharing/tests/js/*.js']
			},
			{
				name: 'files_external',
				srcFiles: [
					// only test these files, others are not ready and mess
					// up with the global namespace/classes/state
					'apps/files_external/js/app.js',
					'apps/files_external/js/mountsfilelist.js'
				],
				testFiles: ['apps/files_external/tests/js/*.js']
			},
			{
				name: 'settings',
				srcFiles: [
					'settings/js/users/deleteHandler.js'
				],
				testFiles: ['settings/tests/js/users/deleteHandlerSpec.js']
			}
		];
	}

	// respect NOCOVERAGE env variable
	// it is useful to disable coverage for debugging
	// because the coverage preprocessor will wrap the JS files somehow
	var enableCoverage = !parseInt(process.env.NOCOVERAGE, 10);
	console.log('Coverage preprocessor: ', enableCoverage?'enabled':'disabled');

	// default apps to test when none is specified (TODO: read from filesystem ?)
	var appsToTest = process.env.KARMA_TESTSUITE;
    if (appsToTest) {
		appsToTest = appsToTest.split(' ');
	}
	else {
		appsToTest = ['core'].concat(findApps());
	}

	console.log('Apps to test: ', appsToTest);

	// read core files from core.json,
	// these are required by all apps so always need to be loaded
	// note that the loading order is important that's why they
	// are specified in a separate file
	var corePath = 'core/js/';
	var vendorPath = 'core/vendor/';
	var coreModule = require('../' + corePath + 'core.json');
	var testCore = false;
	var files = [];
	var index;
	var preprocessors = {};

	// find out what apps to test from appsToTest
	index = appsToTest.indexOf('core');
	if (index > -1) {
		appsToTest.splice(index, 1);
		testCore = true;
	}

	// extra test libs
	files.push(corePath + 'tests/lib/sinon-1.7.3.js');

	// core mocks
	files.push(corePath + 'tests/specHelper.js');

	var srcFile, i;
	// add core library files
	for ( i = 0; i < coreModule.libraries.length; i++ ) {
		srcFile = corePath + coreModule.libraries[i];
		files.push(srcFile);
	}

	// add core modules files
	for ( i = 0; i < coreModule.modules.length; i++ ) {
		srcFile = corePath + coreModule.modules[i];
		files.push(srcFile);
		if (enableCoverage) {
			preprocessors[srcFile] = 'coverage';
		}
	}

	// add vendor library files
	for ( i = 0; i < coreModule.vendor.length; i++ ) {
		srcFile = vendorPath + coreModule.vendor[i];
		files.push(srcFile);
	}

	// TODO: settings pages

	// need to test the core app as well ?
	if (testCore) {
		// core tests
		files.push(corePath + 'tests/specs/*.js');
	}

	function addApp(app) {
		// if only a string was specified, expand to structure
		if (typeof(app) === 'string') {
			app = {
				srcFiles: 'apps/' + app + '/js/*.js',
				testFiles: 'apps/' + app + '/tests/js/*.js'
			};
		}

		// add source files/patterns
		files = files.concat(app.srcFiles || []);
		// add test files/patterns
		files = files.concat(app.testFiles || []);
		if (enableCoverage) {
			// add coverage entry for each file/pattern
			for (var i = 0; i < app.srcFiles.length; i++) {
				preprocessors[app.srcFiles[i]] = 'coverage';
			}
		}
	}

	// add source files for apps to test
	for ( i = 0; i < appsToTest.length; i++ ) {
		addApp(appsToTest[i]);
	}

	// serve images to avoid warnings
	files.push({pattern: 'core/img/**/*', watched: false, included: false, served: true});
	
	// include core CSS
	files.push({pattern: 'core/css/*.css', watched: true, included: true, served: true});

	config.set({

		// base path, that will be used to resolve files and exclude
		basePath: '..',

		// frameworks to use
		frameworks: ['jasmine'],

		// list of files / patterns to load in the browser
		files: files,

		// list of files to exclude
		exclude: [

		],

		proxies: {
			// prevent warnings for images
			'/context.html//core/img/': 'http://localhost:9876/base/core/img/',
			'/context.html//core/css/': 'http://localhost:9876/base/core/css/',
			'/context.html//core/fonts/': 'http://localhost:9876/base/core/fonts/'
		},

		// test results reporter to use
		// possible values: 'dots', 'progress', 'junit', 'growl', 'coverage'
		reporters: ['dots', 'junit', 'coverage'],

		junitReporter: {
			outputFile: 'tests/autotest-results-js.xml'
		},

		// web server port
		port: 9876,

		preprocessors: preprocessors,

		coverageReporter: {
			dir:'tests/karma-coverage',
			reporters: [
				{ type: 'html' },
				{ type: 'cobertura' }
			]
		},

		// enable / disable colors in the output (reporters and logs)
		colors: true,


		// level of logging
		// possible values: config.LOG_DISABLE || config.LOG_ERROR || config.LOG_WARN || config.LOG_INFO || config.LOG_DEBUG
		logLevel: config.LOG_INFO,

		// enable / disable watching file and executing tests whenever any file changes
		autoWatch: true,

		// Start these browsers, currently available:
		// - Chrome
		// - ChromeCanary
		// - Firefox
		// - Opera (has to be installed with `npm install karma-opera-launcher`)
		// - Safari (only Mac; has to be installed with `npm install karma-safari-launcher`)
		// - PhantomJS
		// - IE (only Windows; has to be installed with `npm install karma-ie-launcher`)
		browsers: ['PhantomJS'],

		// If browser does not capture in given timeout [ms], kill it
		captureTimeout: 60000,

		// Continuous Integration mode
		// if true, it capture browsers, run tests and exit
		singleRun: false
  });
};
