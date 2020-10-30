<?php
    namespace Models;

    class Ticket
    {
        private $id;
        private $cinemaName;
        private $movieTitle;
        private $functionDay;
        private $functionHour;
        private $room;

        public function __construct($id="",$cinemaName= "", $movieTitle="",$functionDay="",$functionHour="",$room)
    {   
        $this->id=$id;
        $this->cinemaName=$cinemaName;
        $this->movieTitle=$movieTitle;
        $this->functionDay=$functionDay;
        $this->functionHour=$functionHour;
        $this->room=$room;
    }

        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of movieTitle
         */ 
        public function getMovieTitle()
        {
                return $this->movieTitle;
        }

        /**
         * Set the value of movieTitle
         *
         * @return self
         */ 
        public function setMovieTitle($movieTitle)
        {
                $this->movieTitle = $movieTitle;

                return $this;
        }

        /**
         * Get the value of cinemaName
         */ 
        public function getCinemaName()
        {
                return $this->cinemaName;
        }

        /**
         * Set the value of cinemaName
         *
         * @return self
         */ 
        public function setCinemaName($cinemaName)
        {
                $this->cinemaName = $cinemaName;

                return $this;
        }

        /**
         * Get the value of functionDay
         */ 
        public function getFunctionDay()
        {
                return $this->functionDay;
        }

        /**
         * Set the value of functionDay
         *
         * @return self
         */ 
        public function setFunctionDay($functionDay)
        {
                $this->functionDay = $functionDay;

                return $this;
        }

        /**
         * Get the value of functionHour
         */ 
        public function getFunctionHour()
        {
                return $this->functionHour;
        }

        /**
         * Set the value of functionHour
         *
         * @return self
         */ 
        public function setFunctionHour($functionHour)
        {
                $this->functionHour = $functionHour;

                return $this;
        }

        /**
         * Get the value of room
         */ 
        public function getRoom()
        {
                return $this->room;
        }

        /**
         * Set the value of room
         *
         * @return self
         */ 
        public function setRoom($room)
        {
                $this->room = $room;

                return $this;
        }
    }
?>