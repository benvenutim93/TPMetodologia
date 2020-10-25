<?php
namespace Controllers;

use Models\Functions as Funct;
use DAO\FunctionDao as F_DAO;

class FunctionController{

    private $funtionDao;

    public function __construct()
    {
        $this->funtionDao = new F_DAO();
    }

  
    
  
    public function Add($id_movie,$id_room,$seatsOcupped,$date){


        $function = new Funct($id_room,$id_movie,$seatsOcupped,$date);
       

        $this->funtionDao->Add($function);
        echo '<script>
                alert("La funcion se agrego con exito");
                </script>
                 ';
        require_once(ADMIN_VIEWS . "boardAdmin.php");
 
    }
   




}
?>