<?php
    namespace Repository;

    use Models\Cinema as Cinema;

    class CinemaRepository 
    {        
        private $cinemaList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/cinema.json";
        }

        public function Add(Cinema $cine)
        {
            $this->RetrieveData();
            
            array_push($this->cinemaList, $cine);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->cinemaList;
        }
        
        public function GetOne ($name)
        {
            $this->RetrieveData();

            foreach ($this->cinemaList as $value)
            {
                    if ($value->getName() == $name)
                        return $value;
            }
        }

        public function Remove($name)
        {
            $this->RetrieveData();

            $this->cinemaList = array_filter($this->cinemaList, function($cinema) use($name){
                return $cinema->getName() != $name;
            });

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->cinemaList as $cine)
            {
                $valuesArray["name"] = $cine->getName();
                $valuesArray["address"] = $cine->getAddress();
                $valuesArray["capacity"] = $cine->getCapacity();
                $valuesArray["ticketValue"] = $cine->getTicketValue();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->cinemaList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $cine = new Cinema();
                    $cine->setName($valuesArray["name"]);
                    $cine->setAddress($valuesArray["address"]);
                    $cine->setCapacity($valuesArray["capacity"]);
                    $cine->setTicketValue($valuesArray["ticketValue"]);

                    array_push($this->cinemaList, $cine);
                }
            }
        }

        public function setCinemaList ($list)
        {
            $this->cinemaList = $list;
            $this->SaveData();
        }
    }
?>
