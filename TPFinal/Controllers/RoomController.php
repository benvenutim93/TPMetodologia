<?php 
namespace Controllers;

use Models\Room as Room;
use DAO\RoomDao as R_DAO;

class RoomController{

    private $roomDao;
   

    public function __construct()
    {
        $this->roomDao = new R_DAO();
    }

    public function index($id){
        
        $idCine = $id; 
        require_once(ROOM_VIEWS. "index.php");

    }

    public function showModifyRoom($id){
        $room = $this->roomDao->GetOne($id);
        require_once(ROOM_VIEWS . "modify-form-room.php");
    }
    public function showRoomsListAdmin($id)
    {
        $arrayR= $this->roomDao->GetAll($id);
     
        require_once(ROOM_VIEWS . "roomsListAdmin.php");
    }
  
    public function add($name,$capacity,$price,$idCinema){

        $room = new Room($name,$capacity,$price,$idCinema);

        $this->roomDao->Add($room);
        echo '<script>
                alert("La sala se agrego con Exito al cine");
                </script>
                 ';
        $idCine=$idCinema;
        require_once(ROOM_VIEWS. "index.php");
 
    }
    public function Modify($id,$name,$seatsCapacity,$ticketValue,$idCine)
    {
        echo"entre";
        $this->roomDao->Modify($id, $name, $seatsCapacity, $ticketValue,$idCine);
        $this->showRoomsListAdmin($idCine);
    }


    public function Remove($id)
    {
        $this->roomDao->Remove($id);
        
        $this->showRoomsListAdmin($id);
    }

}

?>