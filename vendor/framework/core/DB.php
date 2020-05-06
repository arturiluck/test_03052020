<?php 

namespace Framework;

use \PDO;

class DB
{    
	private static $options = null;
	private static $_instance = null;

	private function __construct() {}

	private function __clone() {}

	static public function getInstance()
	{

		if(is_null(self::$_instance)) {
			self::$_instance = new PDO(self::$options['driver'].":host=".self::$options['db_host'].";dbname=".self::$options['db_name'].";charset=".self::$options['db_charset'], self::$options['db_user'], self::$options['db_password']);
			self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}

		return self::$_instance;
	}

	static public function setOptions($options)
	{
		self::$options=$options;
	}
}