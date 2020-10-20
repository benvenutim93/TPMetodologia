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
            $this->retrieveAPI();

            return $this->genreList;
        }

        public function GetOne ($id)
        {
            $this->retrieveAPI();

            foreach ($this->genreList as $value)
            {
                    if ($value->getId() == $id)
                        return $value->getName();
            }
            
        }


        public function retrieveAPI()
        {
            $apiContent = file_get_contents(URL_GENRES);
            if ($apiContent)
            {
                $jsonDecode = json_decode($apiContent, true);

                foreach($jsonDecode["genres"] as $value)
                {
                        $genre = new Genre();
                        $genre->setId($value["id"]);
                        $genre->setName($value["name"]);

                        array_push($this->genreList, $genre);
                }
            }
        }

        
}


?>