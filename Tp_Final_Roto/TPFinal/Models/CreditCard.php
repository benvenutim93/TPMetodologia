<?php

namespace Models;

class CreditCard {

    private $owner;
    private $cardNumber;
    private $dateOfExpired;
    private $securityCode;
    private $dni;

    public function __construct()
    {
        
    }



    /**
     * Get the value of owner
     */ 
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set the value of owner
     *
     * @return  self
     */ 
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
    }

    /**
     * Get the value of cardNumber
     */ 
    public function getCardNumber()
    {
        return $this->cardNumber;
    }

    /**
     * Set the value of cardNumber
     *
     * @return  self
     */ 
    public function setCardNumber($cardNumber)
    {
        $this->cardNumber = $cardNumber;

        return $this;
    }

    /**
     * Get the value of dateOfExpired
     */ 
    public function getDateOfExpired()
    {
        return $this->dateOfExpired;
    }

    /**
     * Set the value of dateOfExpired
     *
     * @return  self
     */ 
    public function setDateOfExpired($dateOfExpired)
    {
        $this->dateOfExpired = $dateOfExpired;

        return $this;
    }

    /**
     * Get the value of securityCode
     */ 
    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    /**
     * Set the value of securityCode
     *
     * @return  self
     */ 
    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;

        return $this;
    }

    /**
     * Get the value of dni
     */ 
    public function getDni()
    {
        return $this->dni;
    }

    /**
     * Set the value of dni
     *
     * @return  self
     */ 
    public function setDni($dni)
    {
        $this->dni = $dni;

        return $this;
    }
}


?>