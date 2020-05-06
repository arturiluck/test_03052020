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





die();
Framework\DB::setOptions($config['db']);
//$connection = Framework\DB::getInstance();

$container = new Framework\Container();

$container->set('config', $config);
$container->set('connection', function($container, $parametrs){
	return \Framework\DB::getInstance();;
});
$container->set('request', function($container, $parametrs){
	return new \Framework\BaseRequest(['test' => 'test-2']);
});

 
$container->set('view', function($container, $parametrs){
	return new \Framework\View($container->get('config')['view']);
});

$container->set('response', function($container, $parametrs){
	$response = new \Framework\Response();
	$response->setView($container->get('view'));

	return $response;
});


$view = $container->get('response')->getView()->render('site/index');
echo $view;
print_r($container->get('response'));
/*
$request = new Framework\BaseRequest(['test' => 'test-2']);
var_dump($request);
echo "<hr/>";
$container = new Framework\Container();


$container->set('request', function($container, $parametrs){
	return new \Framework\BaseRequest(['test' => 'test-2']);
});
//var_dump($container);
$profile = $container->get('request');



var_dump($profile);
die("--end--"); 
//$container1->setF('request');  ​

//$profile = $container->get('request');
//var_dump($profile);


*/

die("--end1--");



try {
	(new Framework\Application($config))->run();
	
	die("dsad");
} catch (Exception $e) {
    echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}
// добавляем все маршруты за раз
//Framework\Router::addRoute($routes);

// а можнfо добавлять по одному
//Framework\Router::addRoute('/about', 'MainController/about');

// непосредственно запуск обработки
//Famework\Router::dispatch();

//echo Framework\Router::$requestedUrl;
//echo DIRECTORY_SEPARATOR;
//print_r($_SERVER);