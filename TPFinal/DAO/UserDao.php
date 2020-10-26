<?php

namespace DAO;

use Models\User as User;
use DAO\Connection as Connection;
use \Exception as Exception;

class UserDao
{
    private $tableName = "users";
    private $connection;

    public function __construct()
    {
        
    }

    public function Add(User $user)
        {
            
            try{
                
                $query = " insert into  $this->tableName (name, lastName, userName, pass, mail, dni, birthDate, userType ) VALUES (:name, :lastName, :userName, :pass, :mail, :dni, :birthDate, :userType);";
                
                $parameters["name"] = $user->getName();
                $parameters["lastName"] = $user->getLastName();
                $parameters["userName"] = $user->getUserName();
                $parameters["pass"] = $user->getPass();
                $parameters["mail"] = $user->getMail();
                $parameters["dni"] = $user->getDni();
                $parameters["birthDate"] = $user->getBirthDate();
                $parameters["userType"] = $user->getUserType();
                    

                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
    
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        /**
         * Devuelve un array asociativo con los usuarios cargados al sistema. 
         */

        public function GetAll()
        {
            try
            {
                $query = "select * from $this->tableName ";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $result;

                return $this->movieList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        /**
         * Devuelve un array asociativo con el usuario buscado. 
         */

        public function GetOne ($idUser)
        {
            try
            {
                $query = "select * from $this->tableName where id_user = $idUser";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $result;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function Modify ($id_user, $name, $lastName, $userName, $pass, $mail, $dni, $birthDate, $userType)
        {
            try
            {
            $query = "update $this->tableName set name = :name, lastName = :lastName, userName = :userName, pass = :pass, mail = :mail, dni = :dni, birthDate = :birthDate, userType = :userType where id_user = :id_user;";
            
            $parameters["id_user"] = $id_user;
            $parameters["name"] = $name;
            $parameters["lastName"] = $lastName;
            $parameters["userName"] = $userName;
            $parameters["pass"] = $pass;
            $parameters["mail"] = $mail;
            $parameters["dni"] = $dni;
            $parameters["birthDate"] = $birthDate;
            $parameters["userType"] = $userType;


                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function Remove($userName)
        {
            try
            {
                $query = "delete from $this->tableName where userName = :userName;";

                $parameters["userName"] = $userName;
                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        

    
}

?>