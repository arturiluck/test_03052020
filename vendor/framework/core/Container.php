<?php

namespace Framework;

class Container implements Interfaces\Container
{
	protected $instances = [];
	
	public function set($abstract, $concrete = NULL)
	{
		$this->instances[$abstract] = $concrete;
	}
	
	public function get($abstract, $parameters = [])
	{
		if (!isset($this->instances[$abstract])) {
			$this->set($abstract);
		}

		return $this->resolve($this->instances[$abstract], $parameters);
	}
	
	public function resolve($concrete, $parameters)
	{
		
		if ($concrete instanceof \Closure) {

			return $concrete($this, $parameters);
		}

		return $concrete;
	}
}
