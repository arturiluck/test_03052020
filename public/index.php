<?php
session_start();

try {
	$config = require(dirname(__DIR__) . '/config/config.php');
	require_once dirname(__DIR__) . '/vendor/framework/core/Autoloader.php';

	Framework\Autoloader::setCustomNamespace($config['autoload']);
	Framework\Autoloader::init();

	$container = (new Framework\ContainerFactory($config))->getContainer();
	Framework\Router::addRoute($config['routes']);
	$controller = Framework\Router::dispatch();

	echo $controller($container);
} catch (Framework\Exception\ApiException $e) {
	echo $container->get('response')->response($e->getMessage(), $e->getCode());
} catch (Exception $e) {
	echo $e->getMessage();
}
