<?php
  namespace DAO;

  use Models\Functions as Funct;
  use DAO\Connection as Connection;
  use \Exception as Exception;


  class FunctionDao
  {        
      private $tableName = "functions";
      private $connection;

      public function __construct()
      {
          
      }
      public function Add(Funct $function)
       {
           try{
               $query = " insert into  $this->tableName (id_room,id_movie,occupiedSeats,functionDate ) VALUES (:id_room, :id_movie, :occupiedSeats, :functionDate);";
               
               $parameters["id_room"] = $function->getIdRoom();
               $parameters["id_movie"] = $function->getIdMovie();
               $parameters["occupiedSeats"] = $function->getOccupiedSeats();
               $parameters["functionDate"] = $function->getDate();
   

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