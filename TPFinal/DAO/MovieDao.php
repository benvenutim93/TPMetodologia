<?php
    namespace DAO;

    use Models\Movie as Movie;
    use DAO\Connection as Connection;
    use \Exception as Exception;


    class MovieDao
    {        
        private $tableName = "movies";
        private $connection;

        public function __construct()
        {
            
        }

        public function Add(Movie $movie)
        {
            try{
                $query = " insert into  $this->tableName (title, overview, movieLanguage,vote_avg,releaseDate ) VALUES (:title, :overview, :movieLanguage,:vote_avg,:releaseDate);";
                
                $parameters["title"] = $movie->getTitle();
                $parameters["overview"] = $movie->getOverview();
                $parameters["movieLanguage"] = $movie->getOriginal_language();
                $parameters["vote_avg"] = $movie->getVote_average();
                $parameters["releaseDate"] = $movie->getRelease_date();
    

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
                $movieList = array();
                $query = "select * from $this->tableName ";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach($result as $value)
                {
                    $movie = new Movie();
                    $movie->setTitle($value["title"]);
                    $movie->setOverview($value["overview"]);
                    $movie->setOriginal_title($value["movieLanguage"]);
                    $movie->setVote_average($value["vote_avg"]);
                    $movie->setRelease_date($value["releaseDate"]);

                    array_push($movieList, $movie);
                }

                return $movieList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        
        
        public function GetOne ($idMovie)
        {
            try
            {
                $query = "select * from $this->tableName where id_cine = $idMovie";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach ($result as $value)
                {
                    $movie = new Movie();
                    $movie->setTitle($value["title"]);
                    $movie->setOverview($value["overview"]);
                    $movie->setOriginal_title($value["movieLanguage"]);
                    $movie->setVote_average($value["vote_avg"]);
                    $movie->setRelease_date($value["releaseDate"]);
                }

                return $movie;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
        public function Modify ($id, $title, $overview, $movieLanguage,$vote_avg,$releaseDate)
        {
            try
            {
            $query = "update $this->tableName set title = :title, overview = :overview, movieLanguage = :movieLanguage,vote_avg= :vote_avg, releaseDate=:releaseDate where id_movie = :id_movie;";
            
            $parameters["id_movie"] = $id;
            $parameters["title"] = $title;
            $parameters["overview"] = $overview;
            $parameters["movieLanguage"] = $movieLanguage;
            $parameters["vote_avg"] = $vote_avg;
            $parameters["releaseDate"] = $releaseDate;


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
