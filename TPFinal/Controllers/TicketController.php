<?php
namespace Controllers;

require 'vendor/autoload.php';

use Models\Ticket as Ticket;
use DAO\TicketDao as TicketDao;
use Endroid\QrCode\QrCode;
use DAO\FunctionDao as F_DAO;
use DAO\CreditCardDao as C_DAO;

class TicketController
{
    private $ticketDao;
    private $functionDao;
    private $creditCardDao;

    public function __construct()
    {
        $this->ticketDao = new TicketDao();
        $this->functionDao = new F_DAO();
        $this->creditCardDao = new C_DAO();
    }

    public function generateTicket($cantidad ,$idFuncion){
    
        for($i=0; $i < $cantidad;$i++){
            $id_funcion =$idFuncion;
            $function = $this->functionDao->GetMovieDataForFunction($idFuncion);
            foreach ($function as $value)
            {
                $qr = new QrCode($value["title"], $value["functionsHour"], $value["functionDate"], $value["roomName"], $value["cinemaName"]);
                $imageString= $qr->writeString($value);
                
                $imageData = base64_encode($imageString);
                //echo '<img src="data:image/png;base64,'.$imageData.'">';
            }
        $this->ticketDao->add($id_funcion,$imageString);
        //agregar a otra tabla

        }
    }

    public function showListCards($cantidad,$idFuncion, $idUser)
    {
        $cardsList = $this->creditCardDao->GetAll($idUser);
        require_once(USER_VIEWS . "tarjeta-compra-form.php");
    }
    
    public function purchaseProcess($cantidad,$idFuncion,$idCreditCard, $date)
    {
        $this->generateTicket($cantidad, $idFuncion);
    }

}

?>