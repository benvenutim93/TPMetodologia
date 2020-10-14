<?php

namespace Repository;

Use Models\Admin as Admin;

class AdminRepository{

    private $adminlist;
    private $fileName;

    public function __construct()
    {
        $this->adminlist = array();
        $this->fileName = dirname(__DIR__)."/Data/admins.json";
    }

    public function Add(Admin $admin)
    {
        $this->RetrieveData();
        
        array_push($this->adminlist, $admin);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->adminlist;
    }

    
    public function Remove($userName)
    {
        $this->RetrieveData();

        $this->adminlist = array_filter($this->adminlist, function($users) use($userName){
            return $users->getUsername() != $userName; //WTF
        });

        $this->SaveData();
    }

    private function SaveData()
    {
        $arrayToEncode = array();

        foreach($this->adminlist as $admin)
        {
            $valuesArray["name"] = $admin->getName();
            $valuesArray["lastName"] = $admin->getLastName();
            $valuesArray["dni"] = $admin->getDni();
            $valuesArray["birthDate"] = $admin->getBirthDate();
            $valuesArray["mail"] = $admin->getMail();
            $valuesArray["userName"] = $admin->getUserName();
            $valuesArray["pass"] = $admin->getPass();
            $valuesArray["isAdmin"] = $admin->getIsAdmin();
            
            
            array_push($arrayToEncode, $valuesArray);
        }

        $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
        
        file_put_contents($this->fileName, $jsonContent);
    }

    private function RetrieveData()
    {
        $this->adminlist = array();

        if(file_exists($this->fileName))
        {
            $jsonContent = file_get_contents($this->fileName);

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $admin = new Admin();
                $admin->setName($valuesArray["name"]);
                $admin->setLastName($valuesArray["lastName"]);
                $admin->setDni($valuesArray["dni"]);
                $admin->setBirthDate($valuesArray["birthDate"]);
                $admin->setMail($valuesArray["mail"]);
                $admin->setUserName($valuesArray["userName"]);
                $admin->setPass($valuesArray["pass"]);
                $admin->setIsAdmin($valuesArray["isAdmin"]);

                array_push($this->adminlist, $admin);
            }
        }
    }

}