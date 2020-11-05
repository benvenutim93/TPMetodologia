<?php
    namespace DAO;

    use Models\Pucharse as Pucharse;
    use DAO\Connection as Connection;
    use \Exception as Exception;

    class PurchaseDao
    {
        private $tableName = "purchases";
        private $connection;

        public function __construct()
        {
              
        }

        public function add($total,$idCreditCard,$date){
                
            try{
                $query = " insert into $this->tableName (total, id_creditCard, purchaseDate) VALUES (:total,:id_creditCard ,:purchaseDate );
                ";
                $parameters["total"] = $total;
                $parameters["id_creditCard"] = $idCreditCard;
                $parameters["purchaseDate"] = $date;

                $this->connection = Connection :: GetInstance();
                $this->connection->ExecuteNonQuery($query, $parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        #trae La id de la Ultima compra HECHA
        public function getLastPurchaseID(){
                
            try{
                $query = "select id_purchase from $this->tableName order by id_purchase desc limit 1 ;";
               
                $this->connection = Connection :: GetInstance();
                return $this->connection->Execute($query);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        #trae DAtos  de una compra especifica (IDPURCHASE)
        public function getPurchaseInfo($idPurchase){
                
            try{
                $query = "select p.total,
                p.purchaseDate as Fecha,
                u.mail,
                u.userName as Usuario
                from $this->tableName as p
                inner join tickets
                on tickets.id_purchase = p.id_purchase
                inner join creditcards as c
                on p.id_creditCard= c.id_creditCard
                inner join users as u
                on u.id_user = c.id_user
                where p.id_purchase = $idPurchase;";
               
                $this->connection = Connection :: GetInstance();
                return $this->connection->Execute($query);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        #trae DAtos de todas las compras hechas por un usuario (IDUSER)
        public function getAllPurchase($idUser){

            try{
                $query="select   p.purchaseDate as FechaCompra,
            DATE_FORMAT(f.functionDate, '%Y-%m-%d') as FechaFuncion,
           r.roomName,
           c.cinemaName,
           m.title
                from purchases as p 
                join tickets as t
                on p.id_purchase = t.id_purchase
                join functions as f
                on t.id_function = f.id_function
                    join rooms as r
                    on f.id_room=r.id_room
                    join cinemas as c
                    on c.id_cine = r.id_cine
                    join movies as m
                    on f.id_movie = m.id_movie
                join creditcards as cc
                on cc.id_creditCard = p.id_creditCard
                join users as u
                on u.id_user=cc.id_user
                where u.id_user = $idUser;";
               
                $this->connection = Connection :: GetInstance();
                return $this->connection->Execute($query);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
            
        }

        public function getPurcharseCinema($dateInicial,$dateFinal,$idCinema)
        {
                try{
                $query="select ifnull(avg(tablaAux.valor),0) as total, tablaAux.name as 'cinemaName'
                from (select 
                cinemas.id_cine,
                functions.id_function,
                rooms.id_room,
                rooms.ticketValue as valor,
                cinemas.cinemaName as name
                from tickets 
                inner join functions
                on tickets.id_function = functions.id_function 
                inner join rooms
                on rooms.id_room = functions.id_room
                inner join cinemas
                on rooms.id_cine= cinemas.id_cine
                inner join purchases
                on purchases.id_purchase = tickets.id_purchase
                where cinemas.id_cine=:idCinema  and purchases.purchaseDate between :dateInicial and :dateFinal)tablaAux;";
                
                        $parameters["idCinema"]= $idCinema;
                        $parameters["dateInicial"]= $dateInicial;
                        $parameters["dateFinal"]= $dateFinal;
               
                $this->connection = Connection :: GetInstance();
                return $this->connection->Execute($query,$parameters);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        

    }



?>