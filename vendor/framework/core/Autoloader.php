<?php

namespace Framework;

final class Autoloader
{
	private static $customNamespace;

	public static function setCustomNamespace($config)
	{
		self::$customNamespace = $config;
	}

	public static function init()
	{
		spl_autoload_register(__NAMESPACE__ .'\Autoloader::getFile', true);
	}

	public static function getFile($className)
	{
		$classDir = strtr(trim($className, "\\"), self::$customNamespace);
		$baseDir = dirname(dirname(dirname(__DIR__)));

		
		if (!strpos($className, "\\")) return true;

		$classFile = $baseDir.DIRECTORY_SEPARATOR.str_replace('\\', DIRECTORY_SEPARATOR, $classDir).'.php';

		if (!file_exists($classFile)) {

		   die("Not fond class ($className) in file($classFile). File does not exist.");
		} else {

		   require_once $classFile;
		}
	}
}