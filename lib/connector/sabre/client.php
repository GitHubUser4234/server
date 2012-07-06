<?php

/**
 * ownCloud
 *
 * @author Bjoern Schiessle
 * @copyright 2012 Bjoern Schiessle <schiessle@owncloud.com>
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

class OC_Connector_Sabre_Client extends Sabre_DAV_Client {
	
	protected $curlSettings;
	
	public function __construct(array $settings) {
		//set default curl settings
		$this->curlSettings = array(
				CURLOPT_RETURNTRANSFER => true,
				// Return headers as part of the response
				CURLOPT_HEADER => true,
				// Automatically follow redirects
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_MAXREDIRS => 5,
				CURLOPT_SSL_VERIFYPEER => true,
				//CURLOPT_SSL_VERIFYPEER	=> false,
		);
		parent::__construct($settings);
	}
	
	public function setCurlSettings($settings) {
		if (is_array($settings)) {
			foreach ($settings as $k => $v) {
				$this->curlSettings[$k] = $v;
			}
		}
	}
	
	/**
	 * Copied from SabreDAV with some modification to use user defined curlSettings
	 * Performs an actual HTTP request, and returns the result.
	 *
	 * If the specified url is relative, it will be expanded based on the base
	 * url.
	 *
	 * The returned array contains 3 keys:
	 *   * body - the response body
	 *   * httpCode - a HTTP code (200, 404, etc)
	 *   * headers - a list of response http headers. The header names have
	 *     been lowercased.
	 *
	 * @param string $method
	 * @param string $url
	 * @param string $body
	 * @param array $headers
	 * @return array
	 */
	public function request($method, $url = '', $body = null, $headers = array()) {

		$this->curlSettings[CURLOPT_POSTFIELDS] = $body;	 
		$url = $this->getAbsoluteUrl($url);
	
		switch ($method) {
			case 'PUT':
				$this->curlSettings[CURLOPT_PUT] = true;
				break;
			case 'HEAD' :
	
				// do not read body with HEAD requests (this is neccessary because cURL does not ignore the body with HEAD
				// requests when the Content-Length header is given - which in turn is perfectly valid according to HTTP
				// specs...) cURL does unfortunately return an error in this case ("transfer closed transfer closed with
				// ... bytes remaining to read") this can be circumvented by explicitly telling cURL to ignore the
				// response body
				$this->curlSettings[CURLOPT_NOBODY] = true;
				$this->curlSettings[CURLOPT_CUSTOMREQUEST] = 'HEAD';
				break;
	
			default:
				$this->curlSettings[CURLOPT_CUSTOMREQUEST] = $method;
				break;
	
		}
	
		// Adding HTTP headers
		$nHeaders = array();
		foreach($headers as $key=>$value) {
	
			$nHeaders[] = $key . ': ' . $value;
	
		}
		$this->curlSettings[CURLOPT_HTTPHEADER] = $nHeaders;
	
		if ($this->proxy) {
			$this->curlSettings[CURLOPT_PROXY] = $this->proxy;
		}
	
		if ($this->userName) {
			$this->curlSettings[CURLOPT_HTTPAUTH] = CURLAUTH_BASIC | CURLAUTH_DIGEST;
			$this->curlSettings[CURLOPT_USERPWD] = $this->userName . ':' . $this->password;
		}
	
		list(
				$response,
				$curlInfo,
				$curlErrNo,
				$curlError
		) = $this->curlRequest($url, $this->curlSettings);
	
		$headerBlob = substr($response, 0, $curlInfo['header_size']);
		$response = substr($response, $curlInfo['header_size']);
	
		// In the case of 100 Continue, or redirects we'll have multiple lists
		// of headers for each separate HTTP response. We can easily split this
		// because they are separated by \r\n\r\n
		$headerBlob = explode("\r\n\r\n", trim($headerBlob, "\r\n"));
	
		// We only care about the last set of headers
		$headerBlob = $headerBlob[count($headerBlob)-1];
	
		// Splitting headers
		$headerBlob = explode("\r\n", $headerBlob);
	
		$headers = array();
		foreach($headerBlob as $header) {
			$parts = explode(':', $header, 2);
			if (count($parts)==2) {
				$headers[strtolower(trim($parts[0]))] = trim($parts[1]);
			}
		}
	
		$response = array(
				'body' => $response,
				'statusCode' => $curlInfo['http_code'],
				'headers' => $headers
		);
	
		if ($curlErrNo) {
			throw new Sabre_DAV_Exception('[CURL] Error while making request: ' . $curlError . ' (error code: ' . $curlErrNo . ')');
		}
	
		if ($response['statusCode']>=400) {
			switch ($response['statusCode']) {
				case 404:
					throw new Sabre_DAV_Exception_NotFound('Resource ' . $url . ' not found.');
					break;
	
				default:
					throw new Sabre_DAV_Exception('HTTP error response. (errorcode ' . $response['statusCode'] . ')');
			}
		}
	
		return $response;
	
	}
	
}