<?php
    namespace Repository;

    use Models\Movie as Movie;

    class MoviesRepository
    {        
        private $movieList;
        #private $fileName;

        public function __construct()
        {
            $this->movieList = array();
            #$this->fileName = dirname(__DIR__)."/Data/moviesNowPlaying.json";
        }

        public function GetAll()
        {
            $this->retrieveApi();

            return $this->movieList;
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
                        #return $movie;
                }
            }
        }

    }
?>
