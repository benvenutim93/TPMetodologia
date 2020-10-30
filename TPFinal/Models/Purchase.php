<?php

    namespace Models;

    class Pucharse
    {
        private $id ;
        private $cantEntradas;
        private $idTicket;
        private $total; 
        private $idCreditCard;
        private $date;

        public function __construct($id="",$cantEntradas="",$idTicket="",$total="",$idCreditCard="",$date="")
        {   
            $this->id=$id;
            $this->cantEntradas=$cantEntradas;
            $this->idTicket=$idTicket;
            $this->total=$total;
            $this->idCreditCard=$idCreditCard;
            $this->date=$date;
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
         * Get the value of cantEntradas
         */ 
        public function getCantEntradas()
        {
                return $this->cantEntradas;
        }

        /**
         * Set the value of cantEntradas
         *
         * @return self
         */ 
        public function setCantEntradas($cantEntradas)
        {
                $this->cantEntradas = $cantEntradas;

                return $this;
        }

        /**
         * Get the value of idTicket
         */ 
        public function getIdTicket()
        {
                return $this->idTicket;
        }

        /**
         * Set the value of idTicket
         *
         * @return self
         */ 
        public function setIdTicket($idTicket)
        {
                $this->idTicket = $idTicket;

                return $this;
        }

        /**
         * Get the value of total
         */ 
        public function getTotal()
        {
                return $this->total;
        }

        /**
         * Set the value of total
         *
         * @return self
         */ 
        public function setTotal($total)
        {
                $this->total = $total;

                return $this;
        }

        /**
         * Get the value of idCreditCard
         */ 
        public function getIdCreditCard()
        {
                return $this->idCreditCard;
        }

        /**
         * Set the value of idCreditCard
         *
         * @return self
         */ 
        public function setIdCreditCard($idCreditCard)
        {
                $this->idCreditCard = $idCreditCard;

                return $this;
        }

        /**
         * Get the value of date
         */ 
        public function getDate()
        {
                return $this->date;
        }

        /**
         * Set the value of date
         *
         * @return self
         */ 
        public function setDate($date)
        {
                $this->date = $date;

                return $this;
        }
    }
?>