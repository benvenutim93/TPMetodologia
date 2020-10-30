<?php 
namespace Controllers;

use Models\Room as Room;
use Models\Functions as Functions;
use DAO\RoomDao as R_DAO;
use DAO\MovieDao as M_DAO;
use DAO\CinemaDao as C_DAO;
use \Datetime as Datetime;

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
        $fechaActual=date("Y-m-j");
        require_once(ROOM_VIEWS. "index.php");

    }

    public function showDateForm($date,$idRoom,$idCinema)
    {   
        $movie= new M_DAO();
        
        $tienesalas= $this->roomDao->roomsExists($idCinema);

        foreach($tienesalas as $value){
            if($value["Cantidad Salas"] == 0){
            echo '<script>
                    alert("No hay salas cargadas en el cine");
                    </script>';
                $this->index($idCinema);
            }
            else{
                $cineDao = new C_DAO();
                $arrayR=$this->roomDao->GetAll($idCinema);
                $cine = $cineDao->GetOne($idCinema);
                $arrayNoFunctions= $movie->GetMoviesNotFunction($date);//trae las peliculas que no estan en funcion en un dia determinado
                $arrayFunction=$movie->GetMoviesfunction($date);//trae las peliculas que si estan en funcion en un dia determinado
                $arrayAmostrar=$this->verifiMoviesNoRepeat($arrayNoFunctions,$arrayFunction,$date,$idCinema,$idRoom);
                require_once(FUNCTION_VIEWS . "dateForm.php");
                }
        }
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

    public function showFunctionsList ($idCinema)
    {
        $functions = $this->roomDao->getFunctionsCinema($idCinema);
        
        require_once(FUNCTION_VIEWS . "listFunctionsCinema.php");
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

    public function verifiMoviesNoRepeat($arraysinfunciones,$arrayconfunciones,$date,$idCinema,$idRoom)
    {
       
        $array=array();

      foreach($arrayconfunciones as $elemento) 
      {  
            if($elemento["fecha"] == $date)
            {
                if($elemento["id_cine"] == $idCinema && $elemento["id_room"] == $idRoom )
                {
                        $array["title"]=$elemento["title"];
                        $array["id_movie"]=$elemento["id_movie"];
                        array_push($arraysinfunciones,$array);
                }
            }
      }
      return $arraysinfunciones;
    }

    
}

?>