<?php

namespace App\Controller;

class Authorization extends \Framework\Controller
{
	public function checkAuthorization()
	{
		$authorization = $this->container->get('authorization');
		$response = $this->container->get('response');

		if ($authorization->isGranted()){
			return $response->response($authorization->getAuthorizeUser(), 200);
		}

		return $response->response('', 401);
	}

	public function login()
	{
		$authorization = $this->container->get('authorization');
		$response = $this->container->get('response');
		$request = $this->container->get('request');


		$login = $request->getPost('login');
		$password = $request->getPost('password');

		$authorization->createAccess($login, $password);

		if ($authorization->isGranted()){
			return $response->response($authorization->getAuthorizeUser(), 200);
		}

		return $response->response('', 401);
	}

	public function logout()
	{
		$authorization = $this->container->get('authorization');
		$response = $this->container->get('response');

		if ($authorization->isGranted()){
			$authorization->deleteAccess();

			return $response->response('', 200);
		}

		return $response->response('', 401);
	}
}
