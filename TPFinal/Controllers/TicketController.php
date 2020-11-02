<?php
namespace Controllers;

use Models\Ticket as Ticket;
use DAO\TicketDao as TicketDao;
class TicketController
{
    private $ticketDao;

    public function __construct()
    {
        $this->ticketDao = new TicketDao();
    }

    public function generateTicket($cantidad ,$idFuncion){
    
        for($i=0; $i < $cantidad;$i++){
            $id_funcion =$idFuncion;
            //genero qr

        $this->ticketDao->add($id_funcion);
        }
        

    }

}

?>