<?php

namespace Framework;

class Authorization implements Interfaces\Authorization
{
	private $testDbTable = [
		//login => password
		'test' => 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3',//test,
		'demo' => '89e495e7941cf9e40e6980d14a16bf023ccd4c91',//'demo',
	];

	public function isGranted()
	{
		return isset($_SESSION['granted']) ? true : false;
	}

	public function isDenied()
	{
		return !$this->isGranted();
	}

	public function createAccess($login, $password)
	{
		$passwordFromDb = $this->testDbTable[$login] ?? null;

		if ($passwordFromDb === sha1($password)) {
			$this->login = $login;
			$_SESSION['granted'] = ['login' => $login];

			return $_SESSION['granted'];
		}

		return null;
	}

	public function getAuthorizeUser()
	{
		return $_SESSION['granted'];
	}

	public function deleteAccess()
	{
		unset($_SESSION['granted']);
		session_destroy();
	}
}