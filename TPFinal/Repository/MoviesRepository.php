<?php
    namespace Repository;

    use Models\Movie as Movie;

    class MoviesRepository
    {        
        private $movieList;
        private $fileName;

        public function __construct()
        {
            $this->movieList = array();
            $this->fileName = dirname(__DIR__)."/Data/moviesNowPlaying.json";
        }

        public function Add(Movie $movie)
        {
            $this->RetrieveData();
            
            array_push($this->movieList, $movie);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->movieList;
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->movieList as $movie)
            {
                $valuesArray["popularity"] = $movie->getPopularity();
                $valuesArray["vote_count"] = $movie->getVote_count();
                $valuesArray["video"] = $movie->getVideo();
                $valuesArray["poster_path"] = $movie->getPoster_path();
                $valuesArray["id"] = $movie->getId();
                $valuesArray["adult"] = $movie->getAdult();
                $valuesArray["backdrop_path"] = $movie->getBackdrop_path();
                $valuesArray["original_language"] = $movie->getOriginal_language();
                $valuesArray["original_title"] = $movie->getOriginal_title();
                $valuesArray["genre_ids"] = $movie->getGenre_ids();
                $valuesArray["title"] = $movie->getTitle();
                $valuesArray["vote_average"] = $movie->getVote_average();
                $valuesArray["overview"] = $movie->getOverview();
                $valuesArray["release_date"] = $movie->getRelease_date();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->movieList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $movie = new Movie();
                    $movie->getPopularity($valuesArray["popularity"]);
                    $movie->getVote_count($valuesArray["vote_count"]);
                    $movie->getVideo($valuesArray["video"]);
                    $movie->getPoster_path($valuesArray["poster_path"]);
                    $movie->getId($valuesArray["id"]);
                    $movie->getAdult($valuesArray["adult"]);
                    $movie->getBackdrop_path($valuesArray["backdrop_path"]);
                    $movie->getOriginal_language($valuesArray["original_language"]);
                    $movie->getOriginal_title($valuesArray["original_title"]);
                    $movie->getGenre_ids($valuesArray["genre_ids"]);
                    $movie->getTitle($valuesArray["title"] );
                    $movie->getVote_average($valuesArray["vote_average"]);
                    $movie->getOverview($valuesArray["overview"]);
                    $movie->getRelease_date($valuesArray["release_date"]);

                    array_push($this->movieList, $movie);
                }
            }
        }
    }
?>
