<?php
namespace Controllers;

require 'vendor/autoload.php';

use Models\Ticket as Ticket;
use DAO\TicketDao as TicketDao;
use Endroid\QrCode\QrCode;
use DAO\FunctionDao as F_DAO;

class TicketController
{
    private $ticketDao;
    private $functionDao;

    public function __construct()
    {
        $this->ticketDao = new TicketDao();
        $this->functionDao = new F_DAO();
    }

    public function generateTicket($cantidad ,$idFuncion){
    
        for($i=0; $i < $cantidad;$i++){
            $id_funcion =$idFuncion;
            $function = $this->functionDao->GetMovieDataForFunction($idFuncion);
            foreach ($function as $value)
            {
                var_dump($value);
            
                $qr = new QrCode($value["title"], $value["functionsHour"], $value["functionDate"], $value["roomName"], $value["cinemaName"]);
                $imageString= $qr->writeString($value);
                
                $imageData = base64_encode($imageString);
                //echo '<img src="data:image/png;base64,'.$imageData.'">';
            }
        //$this->ticketDao->add($id_funcion);
        }
        

    }

}

?>