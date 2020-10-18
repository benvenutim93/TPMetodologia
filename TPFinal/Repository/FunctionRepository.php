<?php
    namespace Repository;

    use Models\Functions as Func;

    class CinemaRepository 
    {        
        private $funtionsList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/functions.json";
        }

        public function Add(Func $funct)
        {
            $this->RetrieveData();
            
            array_push($this->funtionsList, $funct);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->funtionsList;
        }
        
        public function GetOne ($id)
        {
            $this->RetrieveData();

            foreach ($this->funtionsList as $value)
            {
                    if ($value->getId() == $id)
                        return $value;
            }
        }

        public function Remove($id)
        {
            $this->RetrieveData();

            $this->funtionsList = array_filter($this->funtionsList, function($funct) use($id){
                return $funct->getId() != $id;
            });

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->funtionsList as $funct)
            {
                $valuesArray["id"] = $funct->getId();
                $valuesArray["hour"] = $funct->getHour();
                $valuesArray["day"] = $funct->getDay();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->funtionsList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $funct = new Cinema();
                    $funct->setId($valuesArray["id"]);
                    $funct->setHour($valuesArray["hour"]);
                    $funct->setDay($valuesArray["day"]);

                    array_push($this->funtionsList, $funct);
                }
            }
        }

        public function setfuntionsList ($list)
        {
            $this->funtionsList = $list;
            $this->SaveData();
        }
    }
?>
