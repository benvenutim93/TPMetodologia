<?php

namespace Controllers;

use Models\Cinema as Cine;
use DAO\CinemaDao as C_DAO;

class CinemaController
{
    private $cinemaDao;

    public function __construct()
    {
        $this->cinemaDao = new C_DAO();
    }

    public function repeatedName ($name, $address)
    {
        $array = $this->cinemaDao->GetAll();
        foreach ($array as $cine)
        {
            if ($cine->getName() == $name || $cine->getAddress() == $address)
                return true;
        }
        
        return false;
    }

    public function showCinemaListAdmin()
    {
        $arrayC= $this->cinemaDao->GetAll();
        require_once(ADMIN_VIEWS . "cinemaListAdmin.php");
    }
    public function showCinemaForm()
    {
        require_once(CINEMA_VIEWS. "cinema-form.php");
    }

    public function showCinemaDelete(){
        require_once(CINEMA_VIEWS . "bajaCinema.php");
    }
    
    public function showCinemas_user()
    {
        $cines = $this->cinemaDao->GetALL();
        require_once(CINEMA_VIEWS . "cinemaList.php");

    }
    public function showCinemaModify($id){
        $movie = $this->cinemaDao->GetOne($id);
        require_once(CINEMA_VIEWS . "modify-form-cinema.php");
    }

    public function Add ($name, $address, $capacity)
    {
        
            $cine = new Cine($name, $address, $capacity);
            
            $this->cinemaDao->Add($cine);
    
        $this->showCinemaListAdmin();
    }

    public function getLastId()
    {
        $array = $this->cinemaDao->GetAll();
        if ($array)
        {
            return count($array)+1;
        }
        else return 1;
    }

    
    public function Remove ($id)
    {
        $this->cinemaDao->Remove($id);
        $this->showCinemaListAdmin();
    }

    public function Modify($id, $name, $address, $capacity)
    {
        $this->cinemaDao->Modify($id, $name, $address, $capacity);
        $this->showCinemaListAdmin();
    }
}
?>