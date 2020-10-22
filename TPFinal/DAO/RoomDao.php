<?php
   namespace DAO;

   use Models\Room as Room;
   use DAO\Connection as Connection;
   use \Exception as Exception;

   class RoomDao
   {        
       private $tableName = "rooms";
       private $connection;

       public function __construct()
       {
           
       }
       public function Add(Room $room)
       {
           try{
               $query = " insert into  $this->tableName (roomName, seatsCapacity, ticketValue, id_cine ) VALUES (:roomName, :seatsCapacity, :ticketValue, :id_cine);";
               
               $parameters["roomName"] = $room->getName();
               $parameters["seatsCapacity"] = $room->getSeatsCapacity();
               $parameters["ticketValue"] = $room->getTicketValue();
               $parameters["id_cine"] = $room->getIdCinema();
   

               $this->connection = Connection :: GetInstance();
               $this->connection->ExecuteNonQuery($query, $parameters);
           }
           catch (\PDOException $ex)
           {
               throw $ex;
           }
       }
        /*
        Trae todas las salas de un cine especifico
        */ 
       public function GetAll($id)
        {
            try
            {
                $roomsList = array();
                $query = "select * from $this->tableName where id_cine = $id";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $value)
                {
                    $room = new Room();
                    $room->setId($value["id_room"]);
                    $room->setname($value["roomName"]);
                    $room->setSeatsCapacity($value["seatsCapacity"]);
                    $room->setTicketValue($value["ticketValue"]);
                    $room->setIdCinema($value["id_cine"]);
                    

                    array_push($roomsList, $room);
                }

                return $roomsList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        public function getOne($id){
            try
            {
               
                $query = "select * from $this->tableName where id_room = $id";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
               foreach($result as $value){
                    $room = new Room();
                    $room->setId($value["id_room"]);
                    $room->setname($value["roomName"]);
                    $room->setSeatsCapacity($value["seatsCapacity"]);
                    $room->setTicketValue($value["ticketValue"]);
                    $room->setIdCinema($value["id_cine"]);
               }

            

                return $room;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }

        }
       public function Modify($id, $name, $seatsCapacity, $ticketValue,$idCine)
        {
            try
            {
            $query = "update $this->tableName set roomName = :roomName, seatsCapacity = :seatsCapacity, ticketValue = :ticketValue where id_cine = :id_cine;";
            
            $parameters["id_cine"] = $idCine;
            $parameters["roomName"] = $name;
            $parameters["seatsCapacity"] = $seatsCapacity;
            $parameters["ticketValue"] = $ticketValue;


                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
            
        }
        public function Remove($id)
        {
            try
            {
                $query = "delete from $this->tableName where id_room = :id;";

                $parameters["id"] = $id;
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