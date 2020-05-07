<?php

namespace Framework;

use \Framework\Exception\ApiException;

final class Router
{

	private static $routes = array();
	private static $params = array();

	public static function addRoute($route, $destination=null, $methods=null)
{
		if ($destination != null && $methods!=null && !is_array($route)) {
			$route = array($route => [$destination, $methods]);
		}
		self::$routes = array_merge(self::$routes, $route);
	}

	private static function splitUrl($url)
	{
		return preg_split('/\//', $url, -1, PREG_SPLIT_NO_EMPTY);
	}

	public static function dispatch($requestedUri = null, $requestedMethod = null)
	{
		if ($requestedUri === null) {
			$requestedUri = urldecode(rtrim(reset(explode('?', $_SERVER["REQUEST_URI"])), '/'));
		}

		if ($requestedMethod === null) {
			$requestedMethod = $_SERVER["REQUEST_METHOD"];
		}

		$requestedUri = ($requestedUri === '') ? '/' : $requestedUri;

		if (isset(self::$routes[$requestedUri])) {

			if (in_array($requestedMethod, end(self::$routes[$requestedUri]))) {
				self::$params = self::splitUrl(reset(self::$routes[$requestedUri]));

				return self::executeAction();
			}
		}

		foreach (self::$routes as $route => &$info) {
			$destination = reset($info);
			$allowedRequestedMethods = end($info);
			
			if (strpos($route, ':') !== false) {
				$route = str_replace(':any', '(.+)', str_replace(':num', '([0-9]+)', $route));
			}

			if (preg_match('#^'.$route.'$#', $requestedUri)) {

				if (strpos($destination, '$') !== false && strpos($route, '(') !== false) {

					$uri = preg_replace('#^'.$route.'$#', $destination, $requestedUri);
				}

				if (!in_array($requestedMethod,$allowedRequestedMethods)) {
					continue;
				}

				self::$params = self::splitUrl($uri);

				break;
			}
		} 

		return self::executeAction();
	} 

	private static function executeAction()
	{

		if (isset(self::$params[0]) && isset(self::$params[1])){
			$controller = self::$params[0];
			$action = self::$params[1];	
			$params = array_slice(self::$params, 2);

			$path = function($container) use ($controller, $action, $params)
			{
				$reflectionMethod = new \ReflectionMethod($controller, $action);
				return $reflectionMethod->invokeArgs(new $controller($container), $params);
			};

			return $path;
			//return fn($container) => new $controller($container))->{$action}($params); // php ^7.4 
		}

		throw new ApiException('', 404);
	}
}
