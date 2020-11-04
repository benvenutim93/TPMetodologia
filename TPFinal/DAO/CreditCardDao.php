<?php
  namespace DAO;

  use Models\CreditCard as CreditCard;

  use DAO\Connection as Connection;
  use \Exception as Exception;


  class CreditCardDao
  {      
    private $tableName = "creditCards";
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

    public function GetAll($id_user)
    {
        try
            {
                $query= "select creditCards.id_creditCard,
                            creditCards.cardHolder,
                            creditCards.expiration,
                            creditCards.expiration,
                            creditCards.numberCC,
                            creditCards.id_user,
                            companies.companyName
                        from creditcards
                        INNER join companies
                        on companies.id_company= creditcards.id_company
                        where creditcards.id_user= 1;";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $result;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
    }
    public function getNumber_Company($idUser){
        try
        {
            $query= "select cc.numberCC,
                    cc.id_creditCard,
            com.companyName
            from $this->tableName as cc
            inner join companies as com
            on com.id_company = cc.id_company
            where cc.id_user =$idUser;";

            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            return $result;
        }
        catch (\PDOException $ex)
        {
            throw $ex;
        }


    }

  }



  ?>