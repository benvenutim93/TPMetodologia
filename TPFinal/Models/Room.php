<?php

namespace Models;

class Room{

    private $id;
    private $name;
    private $numberSeats;
    private $occupiedSeats;
    private $idCinema;
    private $idFunction;
    private $price;

    public function __construct($name="",$numberSeats= "", $occupiedSeats="",$idCinema="",$price="",$idFunction)
    {   
        $this->name=$name;
        $this->numberSeats=$numberSeats;
        $this->occupiedSeats=$occupiedSeats;
        $this->idCinema=$idCinema;
        $this->price=$price;
        $this->idfunction=$idFunction;
    }

    
    public function getNumberSeats()
    {
        return $this->numberSeats;
    }

    public function setNumberSeats($numberSeats)
    {
        $this->numberSeats = $numberSeats;

        return $this;
    }

    public function getOccupiedSeats()
    {
        return $this->occupiedSeats;
    }

    public function setOccupiedSeats($occupiedSeats)
    {
        $this->occupiedSeats = $occupiedSeats;

        return $this;
    }

    public function getIdCinema()
    {
        return $this->idCinema;
    }

    public function setIdCinema($idCinema)
    {
        $this->idCinema = $idCinema;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getname()
    {
        return $this->name;
    }

    public function setname($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get the value of idFunction
     */ 
    public function getIdFunction()
    {
        return $this->idFunction;
    }

    /**
     * Set the value of idFunction
     *
     * @return  self
     */ 
    public function setIdFunction($idFunction)
    {
        $this->idFunction = $idFunction;

        return $this;
    }
}
