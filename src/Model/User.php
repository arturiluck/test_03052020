<?php

namespace App\Model;

use \Framework\Model;

class User extends Model {

	public $firstname;
	public $lastname;
	public $email;
	public $phone;

	public function valid()
	{
		$error = parent::valid();

		if(!$this->validEmail()) $error['email'] = 'notvalid';

		return $error;
	}
	
	private function validEmail()
	{
		if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})/", $this->email)){

			return false;
		}

		return true;
	}
}