<?php

namespace Framework;

class Controller implements Interfaces\Controller
{
	public $container;
	
	public function __construct($container)
	{
		$this->container = $container;
	}
}