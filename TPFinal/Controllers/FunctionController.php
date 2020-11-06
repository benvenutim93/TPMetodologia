<?php
namespace Controllers;

use Models\Functions as Funct;
use DAO\FunctionDao as F_DAO;
use DAO\RoomDao as R_DAO;
use \Datetime as Datetime;
use DAO\MovieDao as M_DAO;

class FunctionController{

    private $functionDao;
    private $roomDao;
    private $movieDao;

    public function __construct()
    {
        $this->functionDao = new F_DAO();
        $this->roomDao= new R_DAO();
        $this->movieDao = new M_DAO();
    }

  
    public function Add($id_movie,$id_room,$seatsOcupped,$date,$hour, $idCinema){

        try
        {
            $arrayFunctionRoom=$this->roomDao->getFunctionsRoom($id_room, $date);//Trae los horarios de las funciones que tiene una sala
            if ($this->verifyHours($arrayFunctionRoom, $hour))
                {
                    $function = new Funct($id_room,$id_movie,$seatsOcupped,$date,$hour);
                
                    $nombre = $this->roomDao->GetnameCinema($idCinema)[0];//trae el nombre del cine para pasarle al index
                    
                    $this->functionDao->Add($function);
                    $msgError = array( "description" => "La funcion se agrego con exito",
                            "type" => 2);
                }
            else {
                    $msgError = array( "description" => "La sala se encuentra ocupada en ese horario","type" => 3);;
                }
            
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }
        finally 
        {
            require_once(ROOM_VIEWS . "index.php");

        }
    }

    public function verifyHours ($arrayFunciones, $hora)
    {
        $date = date("H:i", strtotime($hora));
        $hourForm = new Datetime ($hora);
        $flag = 0;

        foreach ($arrayFunciones as $value)
        {
            $horaFuncion = date ("H:i", strtotime($value["functionsHour"]));
            $hour = new Datetime($horaFuncion);
            $hourMax = new Datetime($horaFuncion);
            $hourMax->modify("+2hours,+14minutes");

            
            if($hourForm >= $hour && $hourForm <= $hourMax)
                $flag=1;
        }

        if ($flag ==1)
            return false;
        else
             return true;

    }

    public function showFunctionList($idMovie,$movieTitle)
    {
        //$funciones = $this->functionDao->getFunctionsMovie($idMovie); //todas las pelis con funcion
        //$remaining= $this->functionDa0->getRemainingPlaces($SALA);

        $funciones = array();
        $array = $this->movieDao->getMovieFunctions($movieTitle); 

        $arrayCantidad=$this->functionDao->getCantTicketsFunctions();//devuelve la cantidad de tickets comprados de las diferentes funsiones
        foreach($arrayCantidad as $value)
        {
            $resta=$value["seatsCapacity"]-$value["Cantidad"];
            if($resta>0) 
            {
                foreach($array as $movie){
                if($movie["id_function"] == $value["id_function"] && $movie["functionDate"] >= date("Y-m-d"))
                {
                        $movie["disponible"]=$resta;
                        array_push($funciones,$movie);
                }
            }
            }
        }
        require_once(USER_VIEWS . "functionsList.php");
    }   



}
?>