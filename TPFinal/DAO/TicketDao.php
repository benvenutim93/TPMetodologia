<?php
    namespace DAO;
    use Models\Ticket as Ticket;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class TicketDao
    {
        private $tableName = "tickets";
        private $connection;

        public function add($idFuncion,$qr){
                
            try{
                $query = " insert into  $this->tableName (id_function,qr) VALUES (:id_function,:qr);";
                
                $parameters["id_function"] = $idFuncion;
                $parameters["qr"] = $qr;

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