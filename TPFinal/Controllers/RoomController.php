<?php 
namespace Controllers;

use Models\Room as Room;
use Models\Functions as Functions;
use DAO\RoomDao as R_DAO;
use DAO\MovieDao as M_DAO;

class RoomController{

    private $roomDao;
   

    public function __construct()
    {
        $this->roomDao = new R_DAO();
    }

    public function index($idCinema){
        
        $arrayR= $this->roomDao->GetAll($idCinema);
        $nombre= $this->getCinemaName($idCinema);
        $idCine =$idCinema;

        require_once(ROOM_VIEWS. "index.php");

    }
    public function showDateForm($date, $hour,$idCinema)
    {
        $movie= new M_DAO();
        $arrayR=$this->roomDao->GetAll($idCinema);
        $arrayMovie= $movie->GetMoviesNotFunction();
        $arraMovieDate=$movie->GetMoviesNoRepeatDate();
        $arrayMovieNoRepeatDate=$this->verifiMoviesNoRepeat($arrayMovie,$arraMovieDate,$date,$hour);
        $fecha = $date." ".$hour;
        var_dump($arrayMovie);
       
        require_once(FUNCTION_VIEWS . "dateForm.php");
    }

    public function showModifyRoom($id){
        $room = $this->roomDao->GetOne($id);
        require_once(ROOM_VIEWS . "modify-form-room.php");
    }
    public function showRoomsListAdmin($idCinema)
    {

        $arrayR= $this->roomDao->GetAll($idCinema);
        $nombre= $this->getCinemaName($idCinema);
     
        $cantidad=$this->roomDao->countRooms($idCinema);

            foreach($cantidad as $value)
            {
                if($value["cantidad"] > 0)
                require_once(ROOM_VIEWS . "roomsListAdmin.php");
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

        $this->roomDao->Add($room);
        echo '<script>
                alert("La sala se agrego con Exito al cine");
                </script>
                 ';
        $idCine=$idCinema;
        $this->index($idCinema);
 
    }
    public function Modify($id,$name,$seatsCapacity,$ticketValue,$idCine)
    {
        echo"entre";
        $this->roomDao->Modify($id, $name, $seatsCapacity, $ticketValue,$idCine);
        $this->showRoomsListAdmin($idCine);
    }

    public function Remove($id,$idCinema)
    {
        $this->roomDao->Remove($id);
        $cantidad=$this->roomDao->countRooms($idCinema);

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

    public function verifiMoviesNoRepeat($arrayM,$arrayMovieNoRepeat,$date,$hours)
    {
      foreach($arrayMovieNoRepeat as $fecha)
      { 
        $cant=count($fecha);
          for($i=0;$i<$cant;$i++)
          {
            
            if($fecha[$i] instanceof functions)
            {
                
                if( $fecha[$i]->getDate()!=$date)
                {
                    
                array_push($arrayM,$fecha[$i+1]);
                }
            }   
          }
      }
      return $arrayDefinitivo=$arrayM;
    }
    public function getCinemaName($idCinema){
        $nombrea = $this->roomDao->GetnameCinema($idCinema);
        $nombreCine = $nombrea[0];
        return $nombreCine;

    }
}

?>