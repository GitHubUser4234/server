<?php
/**
 * Copyright (c) 2012 Bart Visscher <bartv@thisnet.nl>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
//use Symfony\Component\Routing\Route;

class OC_Router {
	protected $collections = array();
	protected $collection = null;
	protected $root = null;

	protected $generator= null;

	public function __construct() {
		$baseUrl = OC_Helper::linkTo('', 'index.php');
		$method = $_SERVER['REQUEST_METHOD'];
		$host = OC_Request::serverHost();
		$schema = OC_Request::serverProtocol();
		$this->context = new RequestContext($baseUrl, $method, $host, $schema);
		// TODO cache
		$this->root = $this->getCollection('root');
	}

	/**
	 * loads the api routes
	 */
	public function loadRoutes() {
		foreach(OC_APP::getEnabledApps() as $app){
			$file = OC_App::getAppPath($app).'/appinfo/routes.php';
			if(file_exists($file)){
				$this->useCollection($app);
				require_once($file);
				$collection = $this->getCollection($app);
				$this->root->addCollection($collection, '/apps/'.$app);
			}
		}
		$this->useCollection('root');
		require_once('core/routes.php');
	}

	protected function getCollection($name) {
		if (!isset($this->collections[$name])) {
			$this->collections[$name] = new RouteCollection();
		}
		return $this->collections[$name];
	}

	public function useCollection($name) {
		$this->collection = $this->getCollection($name);
	}

	public function create($name, $pattern, array $defaults = array(), array $requirements = array()) {
		$route = new OC_Route($pattern, $defaults, $requirements);
		$this->collection->add($name, $route);
		return $route;
	}

    	public function match($url) {
		$matcher = new UrlMatcher($this->root, $this->context);
		$parameters = $matcher->match($url);
		if (isset($parameters['action'])) {
			$action = $parameters['action'];
			if (!is_callable($action)) {
				var_dump($action);
				throw new Exception('not a callable action');
			}
			unset($parameters['action']);
			call_user_func($action, $parameters);
		} elseif (isset($parameters['file'])) {
			include ($parameters['file']);
		} else {
			throw new Exception('no action available');
		}
	}

	public function getGenerator()
	{
		if (null !== $this->generator) {
			return $this->generator;
		}

		return $this->generator = new UrlGenerator($this->root, $this->context);
	}

	public function generate($name, $parameters = array(), $absolute = false)
	{
		return $this->getGenerator()->generate($name, $parameters, $absolute);
	}
}
