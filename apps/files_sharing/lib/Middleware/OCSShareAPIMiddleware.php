<?php

namespace OCA\Files_Sharing\Middleware;

use OCA\Files_Sharing\API\Share20OCS;
use OCP\AppFramework\Http\Response;
use OCP\AppFramework\Middleware;

class OCSShareAPIMiddleware extends Middleware {

	public function __construct() {
	}

	/**
	 * @param \OCP\AppFramework\Controller $controller
	 * @param string $methodName
	 * @param Response $response
	 * @return Response
	 */
	public function afterController($controller, $methodName, Response $response) {
		if ($controller instanceof Share20OCS) {
			/** @var Share20OCS $controller */
			$controller->cleanup();
		}

		return $response;
	}
}
