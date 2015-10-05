<?php
/**
 * @author Joas Schilling <nickvergessen@owncloud.com>
 * @author Lukas Reschke <lukas@owncloud.com>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin McCorkell <rmccorkell@karoshi.org.uk>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */

namespace OC\Settings\Controller;

use GuzzleHttp\Exception\ClientException;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\Http\Client\IClientService;
use OCP\IConfig;
use OCP\IL10N;
use OCP\IRequest;
use OC_Util;
use OCP\IURLGenerator;

/**
 * @package OC\Settings\Controller
 */
class CheckSetupController extends Controller {
	/** @var IConfig */
	private $config;
	/** @var IClientService */
	private $clientService;
	/** @var \OC_Util */
	private $util;
	/** @var IURLGenerator */
	private $urlGenerator;
	/** @var IL10N */
	private $l10n;

	/**
	 * @param string $AppName
	 * @param IRequest $request
	 * @param IConfig $config
	 * @param IClientService $clientService
	 * @param IURLGenerator $urlGenerator
	 * @param \OC_Util $util
	 * @param IL10N $l10n
	 */
	public function __construct($AppName,
								IRequest $request,
								IConfig $config,
								IClientService $clientService,
								IURLGenerator $urlGenerator,
								\OC_Util $util,
								IL10N $l10n) {
		parent::__construct($AppName, $request);
		$this->config = $config;
		$this->clientService = $clientService;
		$this->util = $util;
		$this->urlGenerator = $urlGenerator;
		$this->l10n = $l10n;
	}

	/**
	 * Checks if the ownCloud server can connect to the internet using HTTPS and HTTP
	 * @return bool
	 */
	private function isInternetConnectionWorking() {
		if ($this->config->getSystemValue('has_internet_connection', true) === false) {
			return false;
		}

		try {
			$client = $this->clientService->newClient();
			$client->get('https://www.owncloud.org/');
			$client->get('http://www.owncloud.org/');
			return true;
		} catch (\Exception $e) {
			return false;
		}
	}

	/**
	 * Checks whether a local memcache is installed or not
	 * @return bool
	 */
	private function isMemcacheConfigured() {
		return $this->config->getSystemValue('memcache.local', null) !== null;
	}

	/**
	 * Whether /dev/urandom is available to the PHP controller
	 *
	 * @return bool
	 */
	private function isUrandomAvailable() {
		if(@file_exists('/dev/urandom')) {
			$file = fopen('/dev/urandom', 'rb');
			if($file) {
				fclose($file);
				return true;
			}
		}

		return false;
	}

	/**
	 * Public for the sake of unit-testing
	 *
	 * @return array
	 */
	public function getCurlVersion() {
		return curl_version();
	}

	/**
	 * Check if the used  SSL lib is outdated. Older OpenSSL and NSS versions do
	 * have multiple bugs which likely lead to problems in combination with
	 * functionality required by ownCloud such as SNI.
	 *
	 * @link https://github.com/owncloud/core/issues/17446#issuecomment-122877546
	 * @link https://bugzilla.redhat.com/show_bug.cgi?id=1241172
	 * @return string
	 */
	private function isUsedTlsLibOutdated() {
		$versionString = $this->getCurlVersion();
		if(isset($versionString['ssl_version'])) {
			$versionString = $versionString['ssl_version'];
		} else {
			return '';
		}

		$features = (string)$this->l10n->t('installing and updating apps via the app store or Federated Cloud Sharing');
		if(!$this->config->getSystemValue('appstoreenabled', true)) {
			$features = (string)$this->l10n->t('Federated Cloud Sharing');
		}

		// Check if at least OpenSSL after 1.01d or 1.0.2b
		if(strpos($versionString, 'OpenSSL/') === 0) {
			$majorVersion = substr($versionString, 8, 5);
			$patchRelease = substr($versionString, 13, 6);

			if(($majorVersion === '1.0.1' && ord($patchRelease) < ord('d')) ||
				($majorVersion === '1.0.2' && ord($patchRelease) < ord('b'))) {
				return (string) $this->l10n->t('cURL is using an outdated %s version (%s). Please update your operating system or features such as %s will not work reliably.', ['OpenSSL', $versionString, $features]);
			}
		}

		// Check if NSS and perform heuristic check
		if(strpos($versionString, 'NSS/') === 0) {
			try {
				$firstClient = $this->clientService->newClient();
				$firstClient->get('https://www.owncloud.org/');

				$secondClient = $this->clientService->newClient();
				$secondClient->get('https://owncloud.org/');
			} catch (ClientException $e) {
				if($e->getResponse()->getStatusCode() === 400) {
					return (string) $this->l10n->t('cURL is using an outdated %s version (%s). Please update your operating system or features such as %s will not work reliably.', ['NSS', $versionString, $features]);
				}
			}
		}

		return '';
	}
	
	/*
	 * Whether the php version is still supported (at time of release)
	 * according to: https://secure.php.net/supported-versions.php
	 *
	 * @return array
	 */
	private function isPhpSupported() {
		$eol = false;

		//PHP 5.4 is EOL on 14 Sep 2015
		if (version_compare(PHP_VERSION, '5.5.0') === -1) {
			$eol = true;
		}

		return ['eol' => $eol, 'version' => PHP_VERSION];
	}

	/*
	 * Check if the reverse proxy configuration is working as expected
	 *
	 * @return bool
	 */
	private function forwardedForHeadersWorking() {
		$trustedProxies = $this->config->getSystemValue('trusted_proxies', []);
		$remoteAddress = $this->request->getRemoteAddress();

		if (is_array($trustedProxies) && in_array($remoteAddress, $trustedProxies)) {
			return false;
		}

		// either not enabled or working correctly
		return true;
	}

	/**
	 * @return DataResponse
	 */
	public function check() {
		return new DataResponse(
			[
				'serverHasInternetConnection' => $this->isInternetConnectionWorking(),
				'dataDirectoryProtected' => $this->util->isHtaccessWorking($this->config),
				'isMemcacheConfigured' => $this->isMemcacheConfigured(),
				'memcacheDocs' => $this->urlGenerator->linkToDocs('admin-performance'),
				'isUrandomAvailable' => $this->isUrandomAvailable(),
				'securityDocs' => $this->urlGenerator->linkToDocs('admin-security'),
				'isUsedTlsLibOutdated' => $this->isUsedTlsLibOutdated(),
				'phpSupported' => $this->isPhpSupported(),
				'forwardedForHeadersWorking' => $this->forwardedForHeadersWorking(),
				'reverseProxyDocs' => $this->urlGenerator->linkToDocs('admin-reverse-proxy'),
			]
		);
	}
}
