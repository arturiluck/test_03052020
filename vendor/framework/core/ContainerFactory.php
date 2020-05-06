<?php

namespace Framework;

final class ContainerFactory
{
	private $container;
	private $config;

	public function __construct($config)
	{
		$this->config = $config;
	}
	
	public function factoryMethod()
	{
		$container = new Container();
		$this->container = $container;

		return $container;
	}
	
	public function getContainer()
	{
		$container = $this->factoryMethod();

		$container->set('config', $this->config);

		DB::setOptions($this->config['db']);
		$container->set('connection', function($container, $parametrs){
			return \Framework\DB::getInstance();
		});

		$container->set('authorization', function($container, $parametrs){
			return new \Framework\Authorization();
		});

		$container->set('request', function($container, $parametrs){
			return new \Framework\Request($_REQUEST);
		});

		$container->set('view', function($container, $parametrs){
			return new \Framework\View($container->get('config')['view']);
		});

		$container->set('response', function($container, $parametrs){
			$response = new \Framework\Response();
			$response->setView($container->get('view'));

			return $response;
		});
		
		return $container;
	}
}