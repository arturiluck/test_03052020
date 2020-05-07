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

		if(!$this->validEmail()) $error['email'] = User::NOT_VALID;
		if(!$this->validPhone()) $error['phone'] = User::NOT_VALID;

		return $error;
	}

	private function validEmail()
	{
		if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})/", $this->email)){

			return false;
		}

		return true;
	}

	private function validPhone()
	{
		if(!preg_match("/^[0-9]{10,15}$/", $this->phone)){

			return false;
		}

		return true;
	}
}