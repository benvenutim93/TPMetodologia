<?php
  namespace DAO;

  use Models\CreditCard as CreditCard;

  use DAO\Connection as Connection;
  use \Exception as Exception;


  class CreditCardDao
  {      
    private $tableName = "creditcards";
    private $connection;

    public function __construct()
    {
          
    }
    public function Add(CreditCard $tarjeta,$idUser)
    {
        try{
            $query = " insert into  $this->tableName (cardHolder ,expiration,numberCC,id_company,id_user) VALUES (:cardHolder, :expiration, :numberCC, :id_company, :id_user);";
            
            $parameters["cardHolder"] = $tarjeta->getCardHolder();
            $parameters["expiration"] = $tarjeta->getExpiration();
            $parameters["numberCC"] = $tarjeta->getNumberCC();
            $parameters["id_company"] = $tarjeta->getId_company();
            $parameters["id_user"] = $idUser;
         
         


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