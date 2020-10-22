<?php
    namespace DAO;

    use Models\Cinema as Cinema;
    use DAO\Connection as Connection;
    use \Exception as Exception;


    class CinemaDao
    {        
        private $tableName = "cinemas";
        private $connection;

        public function __construct()
        {
            
        }

        public function Add(Cinema $cine)
        {
            try{
                $query = " insert into  $this->tableName (cinemaName, cinemaAddress, capacity ) VALUES (:cinemaName, :cinemaAddress, :capacity);";
                
                $parameters["cinemaName"] = $cine->getName();
                $parameters["cinemaAddress"] = $cine->getAddress();
                $parameters["capacity"] = $cine->getCapacity();
    

                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
      
        public function GetAll()
        {
            try
            {
                $cinemaList = array();
                $query = "select * from $this->tableName ";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $value)
                {
                    $cinema = new Cinema();
                    $cinema->setId($value["id_cine"]);
                    $cinema->setName($value["cinemaName"]);
                    $cinema->setAddress($value["cinemaAddress"]);
                    $cinema->setCapacity($value["capacity"]);

                    array_push($cinemaList, $cinema);
                }

                return $cinemaList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        
        
        public function GetOne ($id)
        {
            try
            {
                $query = "select * from $this->tableName where id_cine = $id";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach ($result as $value)
                {
                    $cinema = new Cinema();
                    $cinema->setId($value["id_cine"]);
                    $cinema->setName($value["cinemaName"]);
                    $cinema->setAddress($value["cinemaAddress"]);
                    $cinema->setCapacity($value["capacity"]);
                }

                return $cinema;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        public function Modify ($id, $name, $address, $capacity)
        {
            try
            {
            $query = "update $this->tableName set cinemaName = :cinemaName, cinemaAddress = :cinemaAddress, capacity = :capacity where id_cine = :id_cine;";
            
            $parameters["id_cine"] = $id;
            $parameters["cinemaName"] = $name;
            $parameters["cinemaAddress"] = $address;
            $parameters["capacity"] = $capacity;


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
                $query = "delete from $this->tableName where id_cine = :id_cine;";

                $parameters["id_cine"] = $id;
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
