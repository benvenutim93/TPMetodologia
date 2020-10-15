<?php
namespace Models;

class Cinema {

    private $id;
    private $name;
    private $address;
    private $capacity;
    private $ticketValue;

    public function __construct($name = "", $address = "", $capacity = "", $ticketValue = "")
    {
        $this->name = $name;       
        $this->address = $address;        
        $this->capacity = $capacity;   
        $this->ticketValue = $ticketValue;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of capacity
     */ 
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set the value of capacity
     *
     * @return  self
     */ 
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get the value of ticketValue
     */ 
    public function getTicketValue()
    {
        return $this->ticketValue;
    }

    /**
     * Set the value of ticketValue
     *
     * @return  self
     */ 
    public function setTicketValue($ticketValue)
    {
        $this->ticketValue = $ticketValue;

        return $this;
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
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}


?>