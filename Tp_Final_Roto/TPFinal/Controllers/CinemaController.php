<?php

namespace Controllers;

use Models\Cinema as Cine;
use Repository\CinemaRepository as C_Repo;
use Models\Room as Room;

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

    public function showCinemaListAdmin()
    {
        $arrayC= $this->cineRepo->GetAll();
        require_once(ADMIN_VIEWS . "cinemaListAdmin.php");
    }
    public function showCinemaForm()
    {
        require_once(CINEMA_VIEWS. "cinema-form.php");
    }

    public function showCinemaDelete(){
        require_once(CINEMA_VIEWS . "bajaCinema.php");
    }
    public function showCinemaModify($name){
        $movie=$this->cineRepo->GetOne($name);
        require_once(CINEMA_VIEWS . "modify-form-cinema.php");
    }

    public function Add ($name, $address, $capacity,$room,$numberSeat,$price)
    {
    
        if (!$this->repeatedName($name, $address))
        {    
            $sala = new Room($room,$numberSeat,$price,$this->getLastId());
            $cine = new Cine($name, $address, $capacity);
            $cine->setId($this->getLastId());
            $cine->addRoom($sala);
            $this->cineRepo->Add($cine);
        }
        var_dump($cine);
       // $this->showCinemaListAdmin();
    }

    public function getLastId()
    {
        $array = $this->cineRepo->GetAll();
        if ($array)
        {
            return count($array)+1;
        }
        else return 1;
    }

    
    public function Remove ($name)
    {
            $this->cineRepo->Remove($name);

            $this->showCinemaListAdmin();
    }

    public function Modify($id, $name, $address, $capacity){
       $todo = $this->cineRepo->GetAll();

       foreach($todo as $aux)
       {
    
            if($id==$aux->getId())
            {
                $aux->setName($name);
                $aux->setAddress($address);
                $aux->setCapacity($capacity);
                
            }
       }
       $this->cineRepo->setCinemaList($todo);
       $this->showCinemaListAdmin();
    }
}
?>