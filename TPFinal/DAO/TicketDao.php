<?php
    namespace DAO;
    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class TicketDao
    {
        private $tableName = "tickets";
        private $connection;

        public function add($idFuncion){
                
            try{
                $query = " insert into  $this->tableName (id_function) VALUES (:id_function);";
                
                $parameters["id_function"] = $idFuncion;

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