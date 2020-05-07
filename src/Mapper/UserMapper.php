<?php

namespace App\Mapper;

use \Framework\Mapper;
use \App\Model\User;
use \Framework\Exception\ApiException;

class UserMapper extends Mapper{

	public function findById($id)
	{
		try{
			$sql = "SELECT * FROM users WHERE id = :id;";
			$statement = $this->connection->prepare($sql);
			$statement->bindParam("id", $id);
			$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\App\Model\User');

			$statement->execute();
		}catch(\PDOException $e){

			throw new ApiException('Database failure: '.$e->getMessage(), 500);
		}

		return $statement->fetch();
	}

	public function findByEmail($email)
	{
		try{
			$sql = "SELECT * FROM users WHERE email = :email;";
			$statement = $this->connection->prepare($sql);
			$statement->bindParam("email", $email);
			$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\App\Model\User');

			$statement->execute();
		}catch(\PDOException $e){

			throw new ApiException('Database failure: '.$e->getMessage(), 500);
		}

		return $statement->fetch();
	}

	public function findByPhone($phone)
	{
		$sql = "SELECT * FROM users WHERE phone = :phone;";
		$statement = $this->connection->prepare($sql);
		$statement->bindParam("phone", $phone);

		$statement->execute();
		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\App\Model\User');

		return $statement->fetch();
	}

	public function findAll($limit = null)
	{
		$sql = "SELECT * FROM users ORDER BY id desc";
		$sql .= is_null($limit)? ";" : " LIMIT :limit;";

		$statement = $this->connection->prepare($sql);
		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\App\Model\User');

		if (!is_null($limit)){
			$statement->bindParam("limit", $limit);
		}

		$statement->execute();

		return $statement->fetchAll();
	}


	public function save($obj)
	{
		try{
			if ($obj->id) {
				$sql = "UPDATE users SET phone=:phone, firstname=:firstname, lastname=:lastname, email=:email WHERE id = :id;";
				$statement = $this->connection->prepare($sql);

				$statement->bindParam("id", $obj->id);
				$statement->bindParam("phone", $obj->phone);
				$statement->bindParam("firstname", $obj->firstname);
				$statement->bindParam("lastname", $obj->lastname);
				$statement->bindParam("email", $obj->email);

				$statement->execute();
			} else {
				$sql = "INSERT INTO users (phone, firstname, lastname, email) VALUES (:phone, :firstname, :lastname, :email);";
				$statement = $this->connection->prepare($sql);

				$statement->bindParam("phone", $obj->phone);
				$statement->bindParam("firstname", $obj->firstname);
				$statement->bindParam("lastname", $obj->lastname);
				$statement->bindParam("email", $obj->email);

				$statement->execute();
				
				$obj->id = $this->connection->lastInsertId();
			}
		}catch(\PDOException $e){

			throw new ApiException('Database failure: '.$e->getMessage(), 500);
		}

		return $obj;
	}

	public function deleteObject($id)
	{
		try{
			$sql = "DELETE FROM users WHERE id = :id;";
			$statement = $this->connection->prepare($sql);
			$statement->bindParam("id", $id);

			$statement->execute();
		}catch(\PDOException $e){

			throw new ApiException('Database failure: '.$e->getMessage(), 500);
		}

		return true;
	}
}
