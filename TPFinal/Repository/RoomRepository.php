<?php
    namespace Repository;

    use Models\Room as Room;

    class CinemaRepository 
    {        
        private $roomList = array();
        private $fileName;

        public function __construct()
        {
            $this->fileName = dirname(__DIR__)."/Data/room.json";
        }

        public function Add(Room $room)
        {
            $this->RetrieveData();
            
            array_push($this->roomList, $room);

            $this->SaveData();
        }

        public function GetAll()
        {
            $this->RetrieveData();

            return $this->roomList;
        }
        
        public function GetOne ($id)
        {
            $this->RetrieveData();

            foreach ($this->roomList as $value)
            {
                    if ($value->getId() == $id)
                        return $value;
            }
        }

        public function Remove($name)
        {
            $this->RetrieveData();

            $this->roomList = array_filter($this->roomList, function($room) use($name){
                return $room->getName() != $name;
            });

            $this->SaveData();
        }

        private function SaveData()
        {
            $arrayToEncode = array();

            foreach($this->roomList as $room)
            {
                $valuesArray["id"] = $room->getId();
                $valuesArray["name"] = $room->getName();
                $valuesArray["numberSeats"] = $room->getNumberSeats();
                $valuesArray["occupiedSeats"] = $room->getOccupiedSeats();
                $valuesArray["idCinema"] = $room->getIdCinema();
                $valuesArray["price"] = $room->getPrice();

                array_push($arrayToEncode, $valuesArray);
            }

            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            
            file_put_contents($this->fileName, $jsonContent);
        }

        private function RetrieveData()
        {
            $this->roomList = array();

            if(file_exists($this->fileName))
            {
                $jsonContent = file_get_contents($this->fileName);

                $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

                foreach($arrayToDecode as $valuesArray)
                {
                    $room = new Cinema();
                    $room->setId($valuesArray["id"]);
                    $room->setName($valuesArray["name"]);
                    $room->setNumberSeats($valuesArray["numberSeats"]);
                    $room->setOccupiedSeats($valuesArray["occupiedSeats"]);
                    $room->setIdCinema($valuesArray["idCinema"]);
                    $room->setPrice($valuesArray["price"]);

                    array_push($this->roomList, $room);
                }
            }
        }

        public function setRoomList ($list)
        {
            $this->roomList = $list;
            $this->SaveData();
        }
    }
?>
