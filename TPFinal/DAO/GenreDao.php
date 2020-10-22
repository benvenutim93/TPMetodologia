<?php

namespace DAO;

use Models\Genre as Genre;

class GenreDAO
{
    private $tableName = "genres";
    private $connection;

        public function __construct()
        {
            #$this->Add(); Se hace solo una vez y listorti
        }

        public function Add ()
        {
            $genreList = $this->retrieveAPI();
            
            try{
                foreach ( $genreList as $value)
                {
                    $query = " insert into  $this->tableName (id_genre, genreName ) VALUES (:id_genre, :genreName);";
                    
                    $parameters["id_genre"] = $value->getId();
                    $parameters["genreName"] = $value->getName();
                
        
                    $this->connection = Connection :: GetInstance();
                    $this->connection->ExecuteNonQuery($query, $parameters);
                }
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
                $genres = array();
                $query = "select * from $this->tableName ";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $value)
                {
                    $cinema = new Genre();
                    $cinema->setId($value["id_genre"]);
                    $cinema->setName($value["genreName"]);
                    

                    array_push($genres, $cinema);
                }

                return $genres;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }      
         }

        public function GetOneName ($id)
        {
            
            try
            {
                $query = "select * from $this->tableName where id_genre = $id";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);
                
                foreach ($result as $value)
                    return $value["genreName"];
                
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
            
        }


        public function retrieveAPI()
        {
            $apiContent = file_get_contents(URL_GENRES);
            $genreList = array();
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);

                foreach($jsonDecode["genres"] as $value)
                {
                        $genre = new Genre();
                        $genre->setId($value["id"]);
                        $genre->setName($value["name"]);

                        array_push($genreList, $genre);
                }
            }
            return $genreList;
        }

}


?>