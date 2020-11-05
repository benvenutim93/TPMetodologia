<?php
namespace Controllers;

require 'vendor/autoload.php';

use Models\Ticket as Ticket;
use DAO\TicketDao as TicketDao;
use Endroid\QrCode\QrCode;

use DAO\FunctionDao as F_DAO;
use DAO\CreditCardDao as C_DAO;
use DAO\PurchaseDao as P_DAO;
use DAO\RoomDao as R_DAO;


class TicketController
{
    private $ticketDao;
    private $functionDao;
    private $creditCardDao;
    private $purchaseDao;
    private $roomDao;


    public function __construct()
    {
        $this->ticketDao = new TicketDao();
        $this->functionDao = new F_DAO();
        $this->creditCardDao = new C_DAO();
        $this->purchaseDao = new P_DAO();
        $this->roomDao = new R_DAO();
    }

    public function generateTicket($cantidad ,$idFuncion,$idPurchase){
    $array= array();
        for($i=0; $i < $cantidad;$i++){
            $id_funcion =$idFuncion;
            $function = $this->functionDao->GetMovieDataForFunction($idFuncion);
            foreach ($function as $value)
            {
                $qr = new QrCode($value["title"], $value["functionsHour"], $value["functionDate"], $value["roomName"], $value["cinemaName"]);
                $imageString= $qr->writeString($value);
                
                array_push($array,$imageData = base64_encode($imageString));
                //echo '<img src="data:image/png;base64,'.$imageData.'">';
            }
        $this->ticketDao->add($id_funcion,$idPurchase);
        }
        return $array;
    }


    
    public function purchaseProcess($cantidad,$idFuncion,$idCreditCard, $date)
    {
        $price = $this->roomDao->getPriceRoom($idFuncion);
         
       $precioSala=$price[0]["Precio"];

        $total = ($cantidad * $precioSala);
        $this->purchaseDao->add($total,$idCreditCard,$date); //creo compra
        $idUltimaCompra =$this->purchaseDao->getLastPurchaseID();//traigo la id de la ultima compra
    
        $idPurchase=$idUltimaCompra[0]["id_purchase"];
       $qrarray=$this->generateTicket($cantidad, $idFuncion,$idPurchase);//genero los tickets con la id de la compra
        //devuelve un array que contiene los distintos qr de los tikects
        
        require_once(USER_VIEWS . "board.php");
    }
}

?>