<?php
namespace Controllers;

use Models\Functions as Funct;
use DAO\FunctionDao as F_DAO;
use DAO\RoomDao as R_DAO;
use \Datetime as Datetime;


class FunctionController{

    private $functionDao;
    private $roomDao;

    public function __construct()
    {
        $this->functionDao = new F_DAO();
        $this->roomDao= new R_DAO();
    }

  
    public function Add($id_movie,$id_room,$seatsOcupped,$date,$hour){

        try
        {
            $arrayFunctionRoom=$this->roomDao->getFunctionsRoom($id_room, $date);//Trae los horarios de las funciones que tiene una sala
            if ($this->verifyHours($arrayFunctionRoom, $hour))
                {
                    $function = new Funct($id_room,$id_movie,$seatsOcupped,$date,$hour);
                

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
            require_once(ADMIN_VIEWS . "boardAdmin.php");
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
        $id =  $idMovie;
        $titulo =$movieTitle;
        $funciones = $this->functionDao->getFunctionsMovie($id);

        require_once(USER_VIEWS . "functionsList.php");
}   



}
?>