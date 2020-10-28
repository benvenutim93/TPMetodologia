<?php
namespace Controllers;

use Models\Functions as Funct;
use DAO\FunctionDao as F_DAO;
use DAO\RoomDao as R_DAO;


class FunctionController{

    private $funtionDao;
    private $roomDao;

    public function __construct()
    {
        $this->funtionDao = new F_DAO();
        $this->roomDao= new R_DAO();
    }

  
    public function Add($id_movie,$id_room,$seatsOcupped,$date,$hour){

    
       $arrayFunctionRoom=$this->roomDao->getFunctionsRoom($id_room, $date);//Trae los horarios de las funciones que tiene una sala
        $function = new Funct($id_room,$id_movie,$seatsOcupped,$date,$hour);
       

         $this->funtionDao->Add($function);
         echo '<script>
                alert("La funcion se agrego con exito");
                </script>
                 ';
        require_once(ADMIN_VIEWS . "boardAdmin.php");
 
    }

}
?>