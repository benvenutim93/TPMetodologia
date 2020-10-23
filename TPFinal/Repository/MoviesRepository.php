<?php
    namespace Repository;

    use Models\Movie as Movie;

    class MoviesRepository
    {        
        private $movieList;

        public function __construct()
        {
            $this->movieList = array();
        }

        public function GetAll()
        {
            $jsonApi = $this->retrieveApi();

            return $jsonApi;
        }


        public function retrieveAPI()
        {
            $apiContent = file_get_contents(URL_NOWPLAYING);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);
                return $jsonDecode["results"];

            }
        }

    }
?>
