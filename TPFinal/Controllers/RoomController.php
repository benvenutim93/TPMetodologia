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
        $idCine=$id;

        require_once(ROOM_VIEWS. "index.php");

    }

    public function showRoomsListAdmin()
    {
        $arrayR= $this->roomDao->GetAll();
        require_once(ROOM_VIEWS . "roomsListAdmin.php");
    }
  
    public function add($name,$capacity,$price,$idCinema){

        $room = new Room($name,$capacity,$price,$idCinema);

        $this->roomDao->Add($room);
        $idCine=$idCinema;
        require_once(ROOM_VIEWS. "index.php");
      
    

    }

}

?>