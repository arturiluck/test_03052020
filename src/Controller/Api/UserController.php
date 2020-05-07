<?php

namespace App\Controller\Api;

use \Framework\Exception\ApiException;
use \App\Model\User;
use \App\Mapper\UserMapper;


class UserController extends \Framework\Controller
{
	public function getUsers()
	{
		$this->checkAuthorization();
		$connection = $this->container->get('connection');
		$response = $this->container->get('response');

		$mapper = new UserMapper($connection);
		$users = $mapper->findAll();

		if(count($users) > 0){
			return $response->response($users, 200);
		}

		return $response->response('', 404);
	}

	public function getUser($id)
	{
		$this->checkAuthorization();
		$connection = $this->container->get('connection');
		$response = $this->container->get('response');

		$mapper = new UserMapper($connection);
		$user = $mapper->findById($id);

		if($user instanceof User){
			return $response->response($user, 200);
		}

		return $response->response('', 404);
	}

	public function editUser($id)
	{
		print_r($id);
		$this->checkAuthorization();
		$request = $this->container->get('request');
		$connection = $this->container->get('connection');
		$response = $this->container->get('response');

		$user = new User($request->getPost());
		$mapper = new UserMapper($connection);
		$user->id = $id;
		//$mapper->getDirtyProperties()
		
		$errors = $user->valid();

		if(count($errors) === 0){
			print_r($user);
			die();
			$mapper = new UserMapper($connection);

			if ($mapper->findByEmail($user->email)) $errors['email'] = User::EXIST;
			if ($mapper->findByPhone($user->phone)) $errors['phone'] = User::EXIST;

			if(count($errors) === 0){
				$mapper->save($user);

				return $response->response($user, 200);
			}
		}

		return $response->response($errors, 400);
	}

	public function createUser()
	{
		$this->checkAuthorization();

		$request = $this->container->get('request');
		$connection = $this->container->get('connection');
		$response = $this->container->get('response');

		$user = new User($request->getPost());
		$errors = $user->valid();

		unset($user->id);

		if(count($errors) === 0){
			$mapper = new UserMapper($connection);

			if ($mapper->findByEmail($user->email)) $errors['email'] = User::EXIST;
			if ($mapper->findByPhone($user->phone)) $errors['phone'] = User::EXIST;

			if(count($errors) === 0){
				$mapper->save($user);

				return $response->response($user, 200);
			}
		}

		return $response->response($errors, 400);
	}

	public function deleteUser($id)
	{
		$this->checkAuthorization();
		$connection = $this->container->get('connection');
		$response = $this->container->get('response');

		$mapper = new UserMapper($connection);
		$mapper->deleteObject($id);

		return $response->response('', 200);
	}

	private function checkAuthorization()
	{
		$authorization = $this->container->get('authorization');

		if ($authorization->isDenied()){
			throw new ApiException('', 401);
		}
	}
}
