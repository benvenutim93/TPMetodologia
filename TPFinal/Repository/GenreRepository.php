<?php

namespace Repository;

use Models\Genre as Genre;

class GenreRepository
{
        private $genreList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/genreList.json";
        }

        public function Add(Genre $genre)
        {
            $this->RetrieveData();
            
            array_push($this->genreList, $genre);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->genreList;
        }

        public function GetOne ($id)
        {
            $this->RetrieveData();

            foreach ($this->genreList as $value)
            {
            
                    if ($value->getId() == $id)
                        return $value->getName();
                
            }
            
        }

        public function Remove($name)
        {
            $this->RetrieveData();

            $this->genreList = array_filter($this->genreList, function($Genre) use($name){
                return $Genre->getName() != $name;
            });

            $this->SaveData();
        }

        private function SaveData()
        {
           
            $arrayToDecode = array();
            $genre = array("genres" => $arrayToDecode);
            
            foreach($this->genreList as $genre)
            {
                $valuesArray["id"] = $genre->getId();
                $valuesArray["name"] = $genre->getName();


                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($genre, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->genreList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    foreach ($valuesArray as $value)
                    {
                        $genre = new Genre();
                        $genre->setId($value["id"]);
                        $genre->setName($value["name"]);
        
                    array_push($this->genreList, $genre);
                    }
                }
            }
        }
}


?>