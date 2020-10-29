<?php 
namespace Controllers;

use Models\Room as Room;
use Models\Functions as Functions;
use DAO\RoomDao as R_DAO;
use DAO\MovieDao as M_DAO;
use DAO\CinemaDao as C_DAO;

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
        $cine= new C_DAO();
        
        $tienesalas= $this->roomDao->roomsExists($idCinema);

       // var_dump($functionsRoom);
       if($idRoom ==0)
            $arrayHoras=$this->GetArrayHourCinemaIDpar();
        else if($idRoom%2 ==0)
            $arrayHoras=$this->GetArrayHourCinemaIDpar();
        else
            $arrayHoras=$this->GetArrayHourCinemaIDimpar();

        $arrayFunctionRoom=$this->roomDao->getFunctionsRoom($idRoom, $date); //devuelve las funciones de una sala en un dia determinado
        echo "<pre>"; var_dump($arrayFunctionRoom); echo "</pre>";
        $arrayHour=$this->VerifyHour($arrayHoras,$arrayFunctionRoom);

        foreach($tienesalas as $value){
            if($value["Cantidad Salas"] == 0){
            echo '<script>
                    alert("No hay salas cargadas en el cine");
                    </script>';
                $this->index($idCinema);
            }
            else{
                $arrayR=$this->roomDao->GetAll($idCinema);
                $arrayNoFunctions= $movie->GetMoviesNotFunction($date);//trae las peliculas que no estan en funcion en un dia determinado
                $arrayFunction=$movie->GetMoviesfunction($date);//trae las peliculas que si estan en funcion en un dia determinado
                $arrayAmostrar=$this->verifiMoviesNoRepeat($arrayNoFunctions,$arrayFunction,$date,$idCinema);
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
    
        /*echo"<pre>";
        var_dump($functions);
        echo"</pre>";*/
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

    public function verifiMoviesNoRepeat($arraysinfunciones,$arrayconfunciones,$date,$idCinema)
    {
       
        $array=array();

      foreach($arrayconfunciones as $elemento) 
      {  
            if($elemento["fecha"] == $date)
            {
                if($elemento["id_cine"] == $idCinema )
                {
                        $array["title"]=$elemento["title"];
                        $array["id_movie"]=$elemento["id_movie"];
                        array_push($arraysinfunciones,$array);
                }
            }
      }
      return $arraysinfunciones;
    }

    public function GetArrayHourCinemaIDpar(){
        $array=array();
        $date = date("H:i:s", strtotime("14:00:00"));
        $date1 = date("H:i:s", strtotime("16:15:00"));
        $date2 = date("H:i:s", strtotime("18:30:00"));
        $date3 = date("H:i:s", strtotime("20:45:00"));
        $date4 = date("H:i:s", strtotime("23:00:00"));
        $array[0]=$date;
        $array[1]=$date1;
        $array[2]=$date2;
        $array[3]=$date3;
        $array[4]=$date4;

        return $array;
    }

    public function GetArrayHourCinemaIDimpar(){
        $array=array();
        $date = date("H:i:s", strtotime("15:00:00"));
        $date1 = date("H:i:s", strtotime("17:15:00"));
        $date2 = date("H:i:s", strtotime("19:30:00"));
        $date3 = date("H:i:s", strtotime("21:45:00"));
        $date4 = date("H:i:s", strtotime("24:00:00"));
        $array[0]=$date;
        $array[1]=$date1;
        $array[2]=$date2;
        $array[3]=$date3;
        $array[4]=$date4;

        return $array;
    }

    public function VerifyHour($arrayHoras,$arrayFunctionRoom)
    {
        $array=array();
        //funciones de sala en un dia determinado
        if($arrayFunctionRoom== null) //si no hay funciones ese dia
        {
            return $arrayHoras; //muestra todas las horas disponibles
        }
        else{
            foreach($arrayFunctionRoom as $value)
            {
                foreach($arrayHoras as $hora)
                {
                    if($value["functionsHour"] == $hora)
                    {
                        array_push($array,$hora);
                    }
                }
            }
             $cantidad= count($arrayHoras);
            
            for($i=0;$i<$cantidad;$i++)
            {
                foreach($array as $value)
                {
                    if($arrayHoras[$i]== $value)
                        unset($arrayHoras[$i]);     
                }
            }
           
            return $arrayHoras;
        }
    }
}

?>