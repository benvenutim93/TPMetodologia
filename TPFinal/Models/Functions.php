<?php

namespace Models;


class Functions{
    private $id;
    private $idRoom;
    private $idMovie;
    private $occupiedSeats;
    private $date;


    public function __construct($idRoom="", $idMovie="", $occupiedSeats="", $date="")
    {
        $this->idRoom=$idRoom;
        $this->idMovie=$idMovie;
        $this->occupiedSeats=$occupiedSeats;
        $this->date=$date;
    
    }
    

    

    /**
     * Get the value of idRoom
     */ 
    public function getIdRoom()
    {
        return $this->idRoom;
    }

    /**
     * Set the value of idRoom
     *
     * @return self
     */ 
    public function setIdRoom($idRoom)
    {
        $this->idRoom = $idRoom;

        return $this;
    }

    /**
     * Get the value of idMovie
     */ 
    public function getIdMovie()
    {
        return $this->idMovie;
    }

    /**
     * Set the value of idMovie
     *
     * @return self
     */ 
    public function setIdMovie($idMovie)
    {
        $this->idMovie = $idMovie;

        return $this;
    }

    /**
     * Get the value of occupiedSeats
     */ 
    public function getOccupiedSeats()
    {
        return $this->occupiedSeats;
    }

    /**
     * Set the value of occupiedSeats
     *
     * @return self
     */ 
    public function setOccupiedSeats($occupiedSeats)
    {
        $this->occupiedSeats = $occupiedSeats;

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