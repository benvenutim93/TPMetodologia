<?php
namespace Controllers;

use Models\Functions as funct;
use DAO\FunctionDao as F_DAO;

class FunctionController{

    private $funtionDao;
   

    public function __construct()
    {
        $this->funtionDao = new F_DAO();
    }

    public function index($id){
        
        $idCine = $id; 
        require_once(ROOM_VIEWS. "index.php");

    }

    public function showModifyRoom($id){
        $room = $this->funtionDao->GetOne($id);
        require_once(FUNCTION_VIEWS . "modify-form-room.php");
    }
    public function showRoomsListAdmin($idCinema)
    {

        $arrayR= $this->funtionDao->GetAll($idCinema);
     
        $cantidad=$this->funtionDao->countRooms($idCinema);

            foreach($cantidad as $value)
            {
                if($value["cantidad"] > 0)
                require_once(FUNCTION_VIEWS . "roomsListAdmin.php");
                else 
                {
                    echo '<script>
                    alert("No se encontraron salas en el cine");
                    </script>';
                    $this->index($idCinema);
                }
            }
            
        
    }
  
    public function add($name,$capacity,$price,$idCinema){

        $room = new Room($name,$capacity,$price,$idCinema);

        $this->funtionDao->Add($room);
        echo '<script>
                alert("La sala se agrego con Exito al cine");
                </script>
                 ';
        $idCine=$idCinema;
        require_once(FUNCTION_VIEWS . "index.php");
 
    }
    public function Modify($id,$name,$seatsCapacity,$ticketValue,$idCine)
    {
        echo"entre";
        $this->funtionDao->Modify($id, $name, $seatsCapacity, $ticketValue,$idCine);
        $this->showRoomsListAdmin($idCine);
    }

    public function Remove($id,$idCinema)
    {
        $this->funtionDao->Remove($id);
        $cantidad=$this->funtionDao->countRooms($idCinema);

        foreach($cantidad as $value){ //Dato escalar, es decir es un unico dato
            if($value["cantidad"] > 0)
                $this->showRoomsListAdmin($idCinema);
            else {
                echo '<script>
                alert("No se encontraron salas en el cine");
                </script>
                 ';
                $this->index($idCinema);
            }
        }
    }


}
?>