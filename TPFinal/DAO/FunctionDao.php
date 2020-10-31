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
            $query = " insert into  $this->tableName (id_room,id_movie,occupiedSeats,functionDate,functionsHour ) VALUES (:id_room, :id_movie, :occupiedSeats, :functionDate,:functionsHour);";
            
            $parameters["id_room"] = $function->getIdRoom();
            $parameters["id_movie"] = $function->getIdMovie();
            $parameters["occupiedSeats"] = $function->getOccupiedSeats();
            $parameters["functionDate"] = $function->getDate();
            $parameters["functionsHour"]=$function->getHour();


            $this->connection = Connection :: GetInstance();
            $this->connection->ExecuteNonQuery($query, $parameters);
        }
        catch (\PDOException $ex)
        {
            throw $ex;
        }
     }

     public function getFunctionsMovie($idMovie)
     {
      try
      {
          $query ="select c.cinemaName,
          f.id_function,
          r.roomName,
          r.id_room,
          DATE_FORMAT(f.functionDate, '%Y-%m-%d') as functionDate,
          f.functionsHour 
          from $this->tableName as f
          inner join rooms as r
          on f.id_room = r.id_room
          inner join cinemas as c
          on c.id_cine = r.id_cine
          where f.id_movie = $idMovie;";

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