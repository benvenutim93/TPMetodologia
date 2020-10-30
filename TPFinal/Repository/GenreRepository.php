<?php

namespace Repository;

use Models\Genre as Genre;

class GenreRepository
{
        private $genreList ;
        #private $fileName;

        public function __construct()
        {
            $this->genreList = array();
            #$this->fileName = dirname(__DIR__)."/Data/genreList.json";
        }


        public function GetAll()
        {
            $jsonGenres = $this->retrieveAPI();

            return $jsonGenres;
        }

        public function GetOneName ($genresJson, $id)
        {
            foreach ($genresJson as $value)
            {
                    if ($value["id"] == $id)
                        return $value["name"];
            }
            
        }


        public function retrieveAPI()
        {
            $apiContent = file_get_contents(URL_GENRES);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);
                return $jsonDecode["genres"];
                /*foreach($jsonDecode["genres"] as $value)
                {
                        $genre = new Genre();
                        $genre->setId($value["id"]);
                        $genre->setName($value["name"]);

                        array_push($this->genreList, $genre);
                }*/
            }
        }

        
}


?>