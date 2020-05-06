<?php
define('MIGRATION_PREFIX', 'App\Migrations\Version');

$config = require(dirname(dirname(__DIR__)) . '/config/config.php');
require_once dirname(dirname(__DIR__)) . '/vendor/framework/core/Autoloader.php';

Framework\Autoloader::setCustomNamespace($config['autoload']);
Framework\Autoloader::init();

$allMigrations = [
	20200505143135,
];

Framework\DB::setOptions($config['db']);
$db = Framework\DB::getInstance();

foreach($allMigrations as $migration) {
	$query = (new App\Migrations\Version20200505143135())->{$argv[1]}();

	try {
		$db->exec($query);
	} catch (Exception $e) {
		die("Exception : " . $e->getMessage());
	}

	echo "Migration($migration) has been complated.\n";	
} 
echo "All migration have been complated.\n";	