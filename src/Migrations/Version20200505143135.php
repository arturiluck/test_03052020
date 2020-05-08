<?php

namespace App\Migrations;

use Framework\Interfaces\Migration;


final class Version20200505143135 implements Migration
{
	public function up()
	{
		return 'CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, 
						firstname VARCHAR(255) NOT NULL, 
						lastname VARCHAR(255) NOT NULL,
						email VARCHAR(255) NOT NULL,
						phone VARCHAR(15) NOT NULL, 
						PRIMARY KEY(id)) 
						DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB';
	}

	public function down()
	{
		return 'DROP TABLE users';
	}
}