<?php

    namespace Models;

    class Discount{
        private $id;
        private $percentage;
        private $descript;
        private $minCant;



        public function __construct($percentage="", $descript="", $minCant="")
        {
            $this->percentage=$percentage;
            $this->descript=$descript;
            $this->minCant=$minCant;
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
         * Get the value of percentage
         */ 
        public function getPercentage()
        {
                return $this->percentage;
        }

        /**
         * Set the value of percentage
         *
         * @return self
         */ 
        public function setPercentage($percentage)
        {
                $this->percentage = $percentage;

                return $this;
        }

        /**
         * Get the value of descript
         */ 
        public function getDescript()
        {
                return $this->descript;
        }

        /**
         * Set the value of descript
         *
         * @return self
         */ 
        public function setDescript($descript)
        {
                $this->descript = $descript;

                return $this;
        }

        /**
         * Get the value of minCant
         */ 
        public function getMinCant()
        {
                return $this->minCant;
        }

        /**
         * Set the value of minCant
         *
         * @return self
         */ 
        public function setMinCant($minCant)
        {
                $this->minCant = $minCant;

                return $this;
        }
        }
        
?>