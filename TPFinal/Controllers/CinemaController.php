<?php

namespace Controllers;

use Models\Discount as Discount;
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
        try
        {
            $array = $this->cinemaDao->GetAll();
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. El cine no se ha agregado. Intente nuevamente",
                "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }
        if ($array)
        {
            foreach ($array as $cine)
            {
                if ($cine->getName() == $name || $cine->getAddress() == $address)
                    return true;
            }
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

    public function Add ($name, $address, $capacity, $aper, $cierre)
    {
        
        try
        {
            $cine = new Cine($name, $address, $capacity, $aper, $cierre);
            $this->cinemaDao->Add($cine);
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. El cine no se ha agregado. Intente nuevamente",
                "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        } 
        finally{
            $this->showCinemaListAdmin();
        }
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
        try 
        {
            $this->cinemaDao->Remove($id);
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
                "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        } 
        finally{
            $this->showCinemaListAdmin();
        }
    
        
    }

    public function Modify($id, $name, $address, $capacity, $aperHour, $closeHour)
    {
        try
        {
        $this->cinemaDao->Modify($id, $name, $address, $capacity,$aperHour, $closeHour);
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. El cine no se ha agregado. Intente nuevamente",
                "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        } 
        finally{
            $this->showCinemaListAdmin();
        }
    }
}
?>