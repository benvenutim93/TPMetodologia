<?php
namespace Models;

#use Models\Tarjeta as Tarjeta;

class User
{
    private $name;
    private $lastName;
    private $userName;
    private $pass;
    private $mail;
    private $dni;
    private $birthDate;
    private $userType;
    
    public function __construct($name = "", $lastName = "",$dni = "", $birthDate = "", $mail = "", $userName = "", $pass = "", $userType= "")
    {
        $this->name = $name;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->mail = $mail;
        $this->dni = $dni;
        $this->birthDate = $birthDate;
        $this->userType = $userType;

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
     * Get the value of lastName
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @return  self
     */ 
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get the value of userName
     */ 
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set the value of userName
     *
     * @return  self
     */ 
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get the value of pass
     */ 
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * Set the value of pass
     *
     * @return  self
     */ 
    public function setPass($pass)
    {
        $this->pass = $pass;

        return $this;
    }

    /**
     * Get the value of mail
     */ 
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set the value of mail
     *
     * @return  self
     */ 
    public function setMail($mail)
    {
        $this->mail = $mail;

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



    /**
     * Get the value of birthDate
     */ 
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * Set the value of birthDate
     *
     * @return  self
     */ 
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * Get the value of userType
     */ 
    public function getUserType()
    {
        return $this->userType;
    }

    /**
     * Set the value of userType
     *
     * @return  self
     */ 
    public function setUserType($userType)
    {
        $this->userType = $userType;

        return $this;
    }
}


?>