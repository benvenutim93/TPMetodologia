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
        private $movieList = array();

        public function __construct()
        {
            if(!$this->GetAll())
                $this->Add();
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
                DATE_FORMAT( functions.functionDate, '%Y-%m-%d') as functionDate, 
                functions.functionsHour
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

        public function GetWithFunction ($title)
        {
            try
            {
                $query = "select * 
                from $this->tableName
                inner join functions
                on movies.id_movie = functions.id_movie
                inner join rooms
                on functions.id_room = rooms.id_room
                inner join cinemas
                on rooms.id_cine = cinemas.id_cine
                where movies.title = :title;";
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

        public function retrieveUpcoming ()
        {
            $apiContent = file_get_contents(URL_UPCOMING);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);
                $movieList = array();

                foreach ($jsonDecode["results"] as $value)
                {
                    $movie = new Movie();
                    $movie->setTitle($value["title"]);
                    $movie->setOverview($value["overview"]);
                    $movie->setOriginal_title($value["original_language"]);
                    $movie->setVote_average($value["vote_average"]);
                    $movie->setRelease_date($value["release_date"]);
                    $movie->setAdult($value["adult"]);
                    $movie->setPopularity($value["popularity"]);
                    $movie->setPoster_path($value["poster_path"]);

                    array_push($movieList, $movie);
                }

                return $movieList;

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

        public function GetMoviesNotFunction($fecha)
        {
            $fecha= "'".$fecha." "."00:00:00"."'";
            $movieListNotFunction= array();
            try
            {
                $query ="select DISTINCT
                tablaAux.title,
                tablaAux.id_movie
                from movies
                inner join(
                    select 
                        movies.title,
                        movies.id_movie,
                        ifnull(functions.functionDate,0) as fecha
                    from movies
                    left join functions
                    on movies.id_movie= functions.id_movie)tablaAux
                on tablaAux.fecha <> $fecha ;";
                $this->connection = Connection::GetInstance();

                return $result = $this->connection->Execute($query);
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }

        }

        public function GetMoviesfunction($fecha)
        {
            $fecha ="'".$fecha."'";
            $arrayAux=array();
            $movieListNoRepeatDate= array();
            try
            {
                $query ="select DISTINCT
                movies.title,
                movies.id_movie,
                DATE_FORMAT( functions.functionDate, '%Y-%m-%d') fecha, 
                DATE_FORMAT( functions.functionsHour,'%H:%i:%s') hora,
                tablaAux.id_room,
                tablaAux.id_cine,
                tablaAux.cinemaName
                from functions as funciones
                join movies
                on funciones.id_movie= movies.id_movie
                inner join(select cinemas.id_cine,
                            cinemas.cinemaName,
                            rooms.id_room
                    from rooms
                    inner join cinemas
                    on rooms.id_cine = cinemas.id_cine)tablaAux
                on funciones.id_room = tablaAux.id_room
                join functions
                on funciones.functionDate =  $fecha ";
                $this->connection = Connection::GetInstance();

                return $result = $this->connection->Execute($query);

            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        public function GetWithFunctionGenres ()
        {
            try
            {
                $query = "select * 
                from $this->tableName
                inner join functions
                on movies.id_movie = functions.id_movie
                inner join rooms
                on functions.id_room = rooms.id_room
                inner join cinemas
                on rooms.id_cine = cinemas.id_cine";


                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query);

                $this->movieList = array();

                foreach($result as $value)
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
                        $ids = explode("/",$value["genre_ids"]);
                        $movie->setGenre_ids($ids);
                        $movie->setTitle($value["title"] );
                        $movie->setVote_average($value["vote_average"]);
                        $movie->setOverview($value["overview"]);
                        $movie->setRelease_date($value["release_date"]);

                        array_push($this->movieList, $movie);     
                }

                return $this->movieList;
            }
            catch (\PDOException $ex)
            {
                throw $ex;
            }
        }

        
    }
?>
