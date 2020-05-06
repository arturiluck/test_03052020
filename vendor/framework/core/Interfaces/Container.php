<?php

namespace Framework\Interfaces;

interface Container
{
    public function get($abstract, $parameters);
	public function set($abstract, $concrete);
} 