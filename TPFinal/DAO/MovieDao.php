<?php
    namespace DAO;

    use Models\Movie as Movie;
    use DAO\Connection as Connection;
    use \Exception as Exception;


    class MovieDao
    {        
        private $tableName = "movies";
        private $connection;
        private $movieList= array();

        public function __construct()
        {
            $this->Add();# Se hace solo una vez y listorti
        }

        public function Add()
        {
            $this->retrieveAPI();
            
            try{
                foreach($this->movieList as $movie){
                $query = " insert into  $this->tableName (title, overview, movieLanguage,vote_avg,releaseDate ) VALUES (:title, :overview, :movieLanguage,:vote_avg,:releaseDate);";
                
                $parameters["title"] = $movie->getTitle();
                $parameters["overview"] = $movie->getOverview();
                $parameters["movieLanguage"] = $movie->getOriginal_language();
                $parameters["vote_avg"] = $movie->getVote_average();
                $parameters["releaseDate"] = $movie->getRelease_date();
                    

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

                    array_push($this->movieList, $movie);
                }

                return $this->movieList;
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
        public function retrieveAPI()
        {
            
            $apiContent = file_get_contents(URL_NOWPLAYING);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);

                foreach($jsonDecode["results"] as $value)
                {
                        $movie = new Movie();
                        $movie->setPopularity($value["popularity"]);
                        $movie->setVote_count($value["vote_count"]);
                        $movie->setVideo($value["video"]);
                        $movie->setPoster_path($value["poster_path"]);
                        $movie->setId($value["id"]);
                        $movie->setAdult($value["adult"]);
                        $movie->setBackdrop_path($value["backdrop_path"]);
                        $movie->setOriginal_language($value["original_language"]);
                        $movie->setOriginal_title($value["original_title"]);
                        $movie->setGenre_ids($value["genre_ids"]);
                        $movie->setTitle($value["title"] );
                        $movie->setVote_average($value["vote_average"]);
                        $movie->setOverview($value["overview"]);
                        $movie->setRelease_date($value["release_date"]);

                        array_push($this->movieList, $movie);     
                }

            }
            
        }

        public function GetMoviesNotFunction()
        {
            $movieListNotFunction= array();
            try
            {
                $query ="select * from $this->tableName left join functions on movies.id_movie <>functions.id_movie;";
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

                    array_push($movieListNotFunction, $movie);
                }
var_dump($movieListNotFunction);
                return $movieListNotFunction;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }

        }
        #$query = "select * from $this->tableName where id_cine = $idMovie";
    }
?>