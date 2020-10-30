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

    
       $arrayFunctionRoom=$this->roomDao->getFunctionsRoom($id_room, $date);//Trae los horarios de las funciones que tiene una sala
        if ($this->verifyHours($arrayFunctionRoom, $hour))
        {
       $function = new Funct($id_room,$id_movie,$seatsOcupped,$date,$hour);
       

         $this->functionDao->Add($function);
         echo '<script>
                alert("La funcion se agrego con exito");
                </script>
                 ';
        }
        else {
            echo '<script>
            alert("La sala se encuentra ocupada en ese horario");
            </script>
             ';
        }
        require_once(ADMIN_VIEWS . "boardAdmin.php");
 
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
            $hourMax->modify("+2hours,+15minutes");

            
            if($hourForm >= $hour && $hourForm <= $hourMax)
                $flag=1;
        }

        if ($flag ==1)
            return false;
        else
             return true;

    }

}
?>