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
        $nombrea = $this->roomDao->GetnameCinema($idCinema);
        $nombre=$nombrea[0];
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
           
       
        require_once(FUNCTION_VIEWS . "dateForm.php");
    }

    public function showModifyRoom($id){
        $room = $this->roomDao->GetOne($id);
        require_once(ROOM_VIEWS . "modify-form-room.php");
    }
    public function showRoomsListAdmin($idCinema)
    {

        $arrayR= $this->roomDao->GetAll($idCinema);
        $nombre= $this->roomDao->GetnameCinema($idCinema);
        
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

        $capacidadCine=$this->roomDao->getCinemaCapacity($idCinema);

        $sumCantsalas = $this->roomDao->getRoomCapacity($idCinema);

        $capRooms=$sumCantsalas[0];
        
        foreach($capacidadCine as $value){
         $capRooms["capEnUso"]=$capRooms["capEnUso"]+$capacity;

        if($value["capacity"] >= ($capRooms["capEnUso"]))
        {

           $room = new Room($name,$capacity,$price,$idCinema);
           $this->roomDao->Add($room);
                echo '<script>
                        alert("La sala se agrego con Exito al cine");
                        </script>
                        ';
        }else
        {
            echo '<script>
            alert("Se ha superado la capacidad del cine,vuelva a intentarlo.");
            </script>
            ';
        }
    }
    $this->index($idCinema);
 
    }
    public function Modify($id,$name,$capacity,$ticketValue,$idCinema,$capacityAnterior)
    {
        
        $capacidadCine=$this->roomDao->getCinemaCapacity($idCinema);

        $sumCantsalas = $this->roomDao->getRoomCapacity($idCinema);

        $capRooms=$sumCantsalas[0];
        
        foreach($capacidadCine as $value){
         $capRooms["capEnUso"]=$capRooms["capEnUso"]+$capacity-$capacityAnterior;

        if($value["capacity"] >= ($capRooms["capEnUso"]))
        {
           $this->roomDao->Modify($id, $name, $capacity, $ticketValue,$idCinema);
                echo '<script>
                        alert("La sala se modifico con Exito al cine");
                        </script>
                        ';
        }else
        {
            echo '<script>
            alert("Se ha superado la capacidad del cine,vuelva a intentarlo.");
            </script>
            ';
        }
    }
        $this->showRoomsListAdmin($idCinema);
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
        $cant = count($fecha);
          for($i=0;$i<$cant;$i++)
          {
            if($fecha[$i] instanceof Functions)
            {
                
                if( $fecha[$i]->getDate()!=$date)
                {
                    array_push($arrayM,$fecha[$i+1]);
                }
            }   
          }
      }
      return $arrayM;
    }
}

?>