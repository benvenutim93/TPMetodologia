<?php

namespace Models;

use Models\User as User;

class Admin extends User {
    
    private $isAdmin;

    public function __construct($name = "", $lastName = "",$dni = "", $birthDate = "", $mail = "", $userName = "", $pass = "")
    {
        parent::__construct($name = "", $lastName = "",$dni = "", $birthDate = "", $mail = "", $userName = "", $pass = "");
        $this->isAdmin=true;
    }

    /**
     * Get the value of isAdmin
     */ 
    public function getIsAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * Set the value of isAdmin
     *
     * @return  self
     */ 
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }
}


?>