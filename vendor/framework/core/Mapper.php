<?php

namespace Framework;

abstract class Mapper
{
	protected $connection;

	public function __construct($connection)
	{
		$this->connection = $connection;
	}
	
	abstract public function save($obj);
	abstract public function delete($obj);
}
