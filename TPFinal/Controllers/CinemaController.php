<?php

namespace Controllers;

use Models\Cinema as Cine;
use Repository\CinemaRepository as C_Repo;
class CinemaController
{
    private $cineRepo;

    public function __construct()
    {
        $this->cineRepo = new C_Repo();
    }

    public function repeatedName ($name, $address)
    {
        $array = $this->cineRepo->GetAll();
        foreach ($array as $cine)
        {
            if ($cine->getName() == $name && $cine->getAddress() == $address)
                return true;
        }
        
        return false;
    }

    public function showCinemaList()
    {
        require_once(VIEWS_PATH . "cinemaList.php");
    }

    public function Add ($name, $address, $capacity, $ticketValue)
    {
        if (!$this->repeatedName($name, $address))
        {
            $cine = new Cine($name, $address, $capacity, $ticketValue);
            $this->cineRepo->Add($cine);
        }
        $this->showCinemaList();
    }

    public function Remove ($name, $address)
    {
        #hacer formulario para remover un cine o varios.    
    }


}


?>