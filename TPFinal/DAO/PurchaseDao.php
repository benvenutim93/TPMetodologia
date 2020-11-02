<?php
    namespace DAO;
    use Models\Pucharse as Pucharse;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class PurcharseDao
    {
        private $tableName = "purchases";
        private $connection;

        public function add($idFuncion,$qr){
                
            try{
                $query = " ";
               

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