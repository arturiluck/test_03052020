<?php

namespace App\Controller\Api;

use \Framework\Exception\ApiException;
use \App\Model\User;

class UserController extends \Framework\Controller
{
	public function getUsers()
	{
		echo "getUsers";
	}

	public function getUser($id)
	{
		$this->checkAuthorization();
		$request = $this->container->get('request');

		//$request->getPost()
		//new User($this->getPost())
		die("dsada");

/*
		$obj = new User($this->getPost());
		
		 $obj = new Persons ($this->getPost());
			$errors = $obj->valid();
            $mapper = new PersonsMapper();

            if ($mapper->findByEmail($obj->email)) $errors->email="exist";
            if ($mapper->findByLogin($obj->login)) $errors->login="exist";
            if($errors->count()==0){    
                //$mapper->save($obj);
                (new PersonsApiMapper($this->options))->save($obj);
            }
            $this->view->renderJSON($errors);
		
		echo "dsada";
		*/
		/*
		//$authorization = $this->container->get('authorization');
		//$authorization->createAccess('test', 'test');
		$this->checkAuthorization();
		die();
		//echo "getUser";
		//$response = $this->container->get('response')->renderView('site/index');
		//$response = $this->container->get('response')->renderView('site/index');

		
		$authorization->createAccess('test', 'test');
		$authorization->deleteAccess();
		
		$res = $authorization->isGranted();
		var_dump($res); 
		die();
		return $response;
		*/
	}

	public function editUser($id)
	{
		echo "editUser";
	}

	public function createUser()
	{
		//echo "createUser";
		$this->checkAuthorization();
		$request = $this->container->get('request');

		$user = new User($request->getPost());
		$errors = $user->valid();
		print_r($errors);
		die("dsada");

/*
		$obj = new User($this->getPost());
		
		 $obj = new Persons ($this->getPost());
			$errors = $obj->valid();
            $mapper = new PersonsMapper();

            if ($mapper->findByEmail($obj->email)) $errors->email="exist";
            if ($mapper->findByLogin($obj->login)) $errors->login="exist";
            if($errors->count()==0){    
                //$mapper->save($obj);
                (new PersonsApiMapper($this->options))->save($obj);
            }
            $this->view->renderJSON($errors);
		
		echo "dsada";*/
	}

	public function deleteUser()
	{
		echo "deleteUser";
	}

	private function checkAuthorization()
	{
		$authorization = $this->container->get('authorization');

		if ($authorization->isDenied()){
			throw new ApiException('', 401);
		}
	}
}
