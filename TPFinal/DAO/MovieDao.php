<?php
    namespace DAO;

    use Models\Movie as Movie;
    use Models\Functions as Functions;
    use DAO\Connection as Connection;
    use \Exception as Exception;


    class MovieDao
    {        
        private $tableName = "movies";
        private $connection;
        private $movieList= array();

        public function __construct()
        {
           // $this->Add();# Se hace solo una vez y listorti
        }

        public function getMoviesFunctions()
        {
            try
            {
                $query = "select
                $this->tableName.title,
                $this->tableName.overview,
                $this->tableName.adult,
                $this->tableName.original_language,
                $this->tableName.vote_average,
                $this->tableName.popularity,
                $this->tableName.poster_path,
                cinemas.cinemaName,
                rooms.roomName,
                $this->tableName.genre_ids,
                functions.functionDate
                from $this->tableName
                inner join functions
                on $this->tableName.id_movie = functions.id_movie
                inner join rooms
                on functions.id_room = rooms.id_room
                inner join cinemas
                on cinemas.id_cine = rooms.id_cine;";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                return $result;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function Add()
        {
            $this->retrieveAPIArray();
            
            try{
                foreach($this->movieList as $movie){
                $query = " insert into  $this->tableName (title, overview, original_language,vote_average,release_date, adult, popularity, poster_path, id, original_title, genre_ids ) VALUES (:title, :overview, :original_language,:vote_average,:release_date, :adult, :popularity, :poster_path, :id, :original_title, :genre_ids);";
                
                $parameters["title"] = $movie->getTitle();
                $parameters["overview"] = $movie->getOverview();
                $parameters["original_language"] = $movie->getOriginal_language();
                $parameters["vote_average"] = $movie->getVote_average();
                $parameters["release_date"] = $movie->getRelease_date();
                $parameters["popularity"] = $movie->getPopularity();
                $parameters["poster_path"] = $movie->getPoster_path();
                $parameters["adult"] = $movie->getAdult();
                $parameters["id"] = $movie->getId();
                $parameters["original_title"] = $movie->getOriginal_title();
                $ids = implode("/",$movie->getGenre_ids());
                $parameters["genre_ids"] = $ids;
                    

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
                    $movie->setOriginal_language($value["original_language"]);
                    $movie->setVote_average($value["vote_average"]);
                    $movie->setRelease_date($value["release_date"]);
                    $movie->setAdult($value["adult"]);
                    $movie->setPopularity($value["popularity"]);
                    $movie->setPoster_path($value["poster_path"]);
                    $movie->setId($value["id"]);
                    $movie->setOriginal_title($value["original_title"]);
                    $ids = explode("/",$value["genre_ids"]);
                    $movie->setGenre_ids($ids);

                    
                    array_push($this->movieList, $movie);
                }

                return $this->movieList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetOneName ($title)
        {
            try
            {
                $query = "select * from $this->tableName where title = :title";
                $parameters["title"] = $title;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters);

                return $result;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }



        
        
        public function GetOneId ($idMovie)
        {
            try
            {
                $query = "select * from $this->tableName where id_movie = $idMovie";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                foreach ($result as $value)
                {
                    $movie = new Movie();
                    $movie->setTitle($value["title"]);
                    $movie->setOverview($value["overview"]);
                    $movie->setOriginal_title($value["original_language"]);
                    $movie->setVote_average($value["vote_average"]);
                    $movie->setRelease_date($value["release_date"]);
                    $movie->setAdult($value["adult"]);
                    $movie->setPopularity($value["popularity"]);
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
            $query = "update $this->tableName set title = :title, overview = :overview, movieLanguage = :movieLanguage,vote_average= :vote_average, release_date=:release_date where id_movie = :id_movie;";
            
            $parameters["id_movie"] = $id;
            $parameters["title"] = $title;
            $parameters["overview"] = $overview;
            $parameters["movieLanguage"] = $movieLanguage;
            $parameters["vote_average"] = $vote_avg;
            $parameters["release_date"] = $releaseDate;


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

        
        public function retrieveAPIJson()
        {
            $apiContent = file_get_contents(URL_NOWPLAYING);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);
                return $jsonDecode["results"];

            }
        }
        
        public function retrieveAPIArray()
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
                $query ="select
                $this->tableName.id_movie,
                $this->tableName.title,
                functions.functionDate
                from functions
                right join $this->tableName
                on functions.id_movie = $this->tableName.id_movie
                 WHERE $this->tableName.id_movie not in (select functions.id_movie from functions);";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

         

                foreach($result as $value)
                {
                    $movie = new Movie();
                    $function=new Functions();
                    $movie->setId($value["id_movie"]);
                    $movie->setTitle($value["title"]);
                    $function->setDate($value["functionDate"]);
                    

                    array_push($movieListNotFunction, $movie);
                }
                return $movieListNotFunction;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }

        }

        public function GetMoviesNoRepeatDate()
        {
            $arrayAux=array();
            $movieListNoRepeatDate= array();
            try
            {
                $query ="select
                $this->tableName.title,
                $this->tableName.id_movie,
                DATE_FORMAT( functions.functionDate, '%Y-%m-%d') fecha, 
                DATE_FORMAT( functions.functionDate,'%H:%i:%s') hora
                from functions
                join $this->tableName
                on functions.id_movie= movies.id_movie;";
                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);


                foreach($result as $value)
                {
                    $movie = new Movie();
                    $function=new Functions();
                    $movie->setTitle($value["title"]);
                    $movie->setId($value["id_movie"]);
                    $fecha = $value["fecha"].$value["hora"];
                    $function->setDate($fecha);
                   
                    
                    array_push($arrayAux,$function);
                    array_push($arrayAux,$movie);
                }
                array_push($movieListNoRepeatDate,$arrayAux);
                return $movieListNoRepeatDate;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }
    }
?>
