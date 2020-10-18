<?php

namespace Models;


class Functions{

    private $id;
    private $hour;
    private $day;

    public function __construct($hour="",$day="")
    {
        $this->hour=$hour;
        $this->day=$day;
    }
    

    /**
     * Get the value of hour
     */ 
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set the value of hour
     *
     * @return  self
     */ 
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }


    /**
     * Get the value of day
     */ 
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set the value of day
     *
     * @return  self
     */ 
    public function setDay($day)
    {
        $this->day = $day;

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