<?php

namespace App\Mapper;

use \Framework\Mapper;

class UserMapper extends Mapper{
/*
 	public function getById($id){
 		$sql = "SELECT * FROM persons WHERE id =:id;";
        $statement = $this->db->prepare($sql);
        $statement->bindParam("id", $id);
        $statement->execute();
 		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\module\app\model\Persons');
 		return $statement->fetch();
 	}
    public function findByEmail($email){
		$sql = "SELECT * FROM persons WHERE email LIKE :email;";
        $statement = $this->db->prepare($sql);
        $statement->bindParam("email", $email);
        $statement->execute();
 		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\module\app\model\Persons');
 		return $statement->fetch();
    }
    public function findByLogin($login){
		$sql = "SELECT * FROM persons WHERE login LIKE :login;";
        $statement = $this->db->prepare($sql);
        $statement->bindParam("login", $login);
        $statement->execute();
 		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\module\app\model\Persons');
 		return $statement->fetch();
    }
    public function showAll(){
		$sql = "SELECT * FROM persons ORDER BY id desc LIMIT 10;";
        $statement = $this->db->prepare($sql);
        $statement->bindParam("login", $login);
        $statement->execute();
 		$statement->setFetchMode(\PDO::FETCH_CLASS|\PDO::FETCH_PROPS_LATE, '\module\app\model\Persons');
 		return $statement->fetchAll();
    }


    public function save($obj){
    	try{
	    	if ($obj->id) {
	          	$sql = "UPDATE persons SET login=:login, name=:name, lastname=:lastname, email=:email, password=:password WHERE id = :id;";
	            $statement = $this->db->prepare($sql);
	            $statement->bindParam("id", $obj->id);
	            $statement->bindParam("login", $obj->login);
	            $statement->bindParam("name", $obj->name);
	            $statement->bindParam("lastname", $obj->lastname);
	            $statement->bindParam("email", $obj->email);
	            $statement->bindParam("password", $obj->password);
	            $statement->execute();
	        }
	        else {
	            $sql = "INSERT INTO persons (login, name, lastname, email, password) VALUES (:login, :name, :lastname, :email, :password);";
	            $statement = $this->db->prepare($sql);
	            $statement->bindParam("login", $obj->login);
	            $statement->bindParam("name", $obj->name);
	            $statement->bindParam("lastname", $obj->lastname);
	            $statement->bindParam("email", $obj->email);
	            $statement->bindParam("password", $obj->password);
	            $statement->execute();
	            $obj->id = $this->db->lastInsertId();
	        }	
		}catch(PDOException $e){
			return false;
		}	
		return true;
    }
    public function delete($obj){
	}
	*/
}
