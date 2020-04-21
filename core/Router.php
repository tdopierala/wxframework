<?php

namespace Core;

class Router
{

	/**
	 * Associative array of routes
	 * @var array
	 */
	protected $routes = [];

	/**
	 * Parameters from the matched route
	 * @var array
	 */
	protected $params = [];

	/**
	 * Add a route to the routing table
	 * 
	 * @param string $route The route url
	 * @param array $params Parameters (controller, action, etc.)
	 * 
	 * @return void
	 */
	public function add(string $route, array $params = []) : void
	{
		// convert the route to a regular expression: escape forward slashes
		$route = preg_replace('/\//', '\\/', $route);

		// convert variables e.g. {controller}
		$route = preg_replace('/\{([a-z]+)\}/', '(?P<\1>[a-z-]+)', $route);

		// convert variables with custom regular expressions e.g. {id:\d+}
		$route = preg_replace('/\{([a-z]+):([^\}]+)\}/', '(?P<\1>\2)', $route);

		//add start and end delimiters, and case insensitive flag
		$route = '/^' . $route . '$/i';

		$this->routes[$route] = $params;
	}

	/**
	 * Get all the routes from the routing table
	 * 
	 * @return array
	 */
	public function getRoutes() : array
	{
		return $this->routes;
	}

	/**
	 * Match the route to the routes in the routing table, setting the $params
	 * property if a route is found
	 * 
	 * @param string $url The route URL
	 * 
	 * @return boolean true if a match found, false otherwise
	 */
	public function match(string $url) : bool
	{
		/* foreach($this->routes as $route => $params) {
			if($url == $route) {
				$this->params = $params;
				return true;
			}
		} */

		//$reg_exp = "/^(?P<controller>[a-z-]+)\/(?P<action>[a-z-]+)$/";

		foreach($this->routes as $route => $params) {

			if(preg_match($route, $url, $matches)) {
				//$params = [];

				foreach($matches as $key => $match) {
					if(is_string($key)){
						$params[$key] = $match;
					}
				}

				$this->params = $params;
				return true;
			}
		}

		return false;
	}

	/**
	 * Get the currently matched parameters
	 * 
	 * @return array
	 */
	public function getParams() : array
	{
		return $this->params;
	}

	/**
	 * Dispatch the route
	 * 
	 * @param string $url The route URL
	 * 
	 * @return void
	 */
	public function disaptch(string $url) : void
	{
		$url = $this->removeQueryStringVariables($url);

		if($this->match($url)) {
			$controller = $this->params['controller'];
			$controller = $this->convertToStudlyCaps($controller);
			//$controller = "App\Controller\\$controller";
			$controller = $this->getNamespace() . $controller;

			if(class_exists($controller)) {
				$controller_object = new $controller($this->params);

				if(!array_key_exists('action', $this->params)) {
					$this->params['action'] = 'index';
				}

				$action = $this->params['action'];
				$action = $this->convertToCamelCase($action);

				if(is_callable([$controller_object, $action]) && preg_match('/action$/i', $action) == 0) {
					$controller_object->$action();
				} else {
					throw new \Exception("Method $action (in controller $controller) not found.", 404);
				}
			} else {
				throw new \Exception("Controller class $controller not found.", 404);
			}
		} else {
			throw new \Exception("No route matched.", 404);
		}
	}

	/**
	 * Convert the string with hyphens to StudlyCaps
	 * e.g. post-authors => PostAuthors
	 * 
	 * @param string $string The string to convert
	 * 
	 * @return string
	 */
	protected function convertToStudlyCaps(string $string) : string
	{
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $string)));
	}

	/**
	 * Convert the string with hyphens to camelCase
	 * e.g. add-new => addNew
	 * 
	 * @param string $string The string convert
	 * 
	 * @return string
	 */
	protected function convertToCamelCase(string $string) : string
	{
		return lcfirst($this->convertToStudlyCaps($string));
	}

	/**
	 * Remove the query string variables from the URL (if any). As the full
	 * query string is used for the route, any varaiables at the end will need
	 * to be removed before the route is matched to the routing trable. For
	 * example:
	 * 
	 * 		URL								$_SERVER['QUERY_STRING']	Route
	 * 		-------------------------------------------------------------------
	 * 		localhost						''							''
	 * 		localhost/?						''							''
	 * 		localhost/?page=1				page=1						''
	 * 		localhost/posts?page=1			posts&page=1				posts
	 * 		localhost/posts/index			posts/index					posts/index
	 * 		localhost/posts/index?page=1	posts/index?page=1			posts/index
	 * 
	 * A URL of the format localhost/?page (one variable name, no value) won't
	 * work however. (NB. The .htaccess file converts the first ? to a & when
	 * it's passed through to the $_SERVER variable).
	 * 
	 * @param string $url The full URL
	 * 
	 * @return string The URL with the query string variables removed
	 */
	protected function removeQueryStringVariables(string $url) : string
	{
		if($url != '') {
			$parts = explode('&', $url, 2);

			if(\strpos($parts[0], '=') === false) {
				$url = $parts[0];
			} else {
				$url = '';
			}
		}

		return $url;
	}

	/**
	 * Get the namespace for the controller class. The namespace defined in the route
	 * parameters is added if present.col-12
	 * 
	 * @return string The request URL
	 */
	protected function getNamespace() : string
	{
		$namespace = 'App\Controller\\';

		if(array_key_exists('namespace', $this->params)) {
			$namespace .= $this->params['namespace'] . '\\';
		}

		return $namespace;
	}

}