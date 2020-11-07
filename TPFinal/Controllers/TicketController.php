<?php
namespace Controllers;

require 'vendor/autoload.php';
require('Phpmailer/Exception.php');
require('Phpmailer/SMTP.php');
require('Phpmailer/PHPMailer.php');

use Models\Ticket as Ticket;
use DAO\TicketDao as TicketDao;
use Endroid\QrCode\QrCode;

use DAO\FunctionDao as F_DAO;
use DAO\CreditCardDao as C_DAO;
use DAO\PurchaseDao as P_DAO;
use DAO\RoomDao as R_DAO;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer ;
use PHPMailer\PHPMailer\Exception as MailException;


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
            $this->ticketDao->add($idFuncion,$idPurchase);
        }
        $function = $this->functionDao->GetMovieDataForFunction($idFuncion,$cantidad);
            foreach ($function as $value)
            {
                $qr = new QrCode($value["title"], $value["functionsHour"], $value["functionDate"], $value["roomName"], $value["cinemaName"],$value["id_ticket"]);
                $qr->setEncoding('UTF-8');
               
                $path =ROOT.'png/qrcode'.$value["id_ticket"].'.png';
                $qr->writeFile( $path);      
                
                array_push($array,$path);
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
        $function = $this->functionDao->GetMovieDataForFunction($idFuncion,$cantidad);
        $this->sendMail($qrarray,$function);
        
        require_once(USER_VIEWS . "board.php");
    }

    public function sendMail($qrArray,$function)
    {
        $mail= new PHPMailer(true);


        try {
            //Server settings
            $mail->SMTPDebug = 0;                      // Enable verbose debug output                                                               | 0 PARA NO MOSTRAR ERRORES 
            $mail->isSMTP();                                            // Send using SMTP                                                          | NO TOCAR
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through|NO TOCAR
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication                                               | NO TOCAR
            $mail->Username   = 'supervivientes.iv.2020@gmail.com';         // SMTP username                                                        | MAIL DONDE INGRESA PARA ENVIAR LOS DEMAS
            $mail->Password   = '123super456';                               // SMTP password                                                       | CONTRASEÑA DEL MAIL
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged          | NO TOCAR
            $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above  | NO TOCAR
        
            //Desde que mail se manda (TIENE QUE SER EL MISMO DE LA LINEA 18)
           $mail->setFrom('supervivientes.iv.2020@gmail.com', 'Supervivientes 2020');
           //A donde se manda 
         
            $mail->addAddress('benvenutim93@gmail.com', 'Marian');               // mail / nombre
            $mail->addAddress('lautarofullone@gmail.com', 'Lauta ');           // mail / nombre
            $mail->addAddress('ropeque19@hotmail.com', 'Rodri');               // mail / nombre
            $mail->addAddress('nicolas-jbo@hotmail.com', 'Nico'); 
            foreach($qrArray as $qr)
                $mail->addAttachment($qr);
        //
         $html='<h1>Usted ha realizado una compra mediante la pagina Los Supervivientes</h1>'; 
            // Content
            $mail->isHTML(true);                                  // Set email fo
            $mail->Subject = 'Asunto pruebita de mail con PHPMailer';// Asunto
            $mail->Body    = $html;                                     //Body del mail
            
            $mail->send();
            echo '<script>
            alert("El mensaje fue enviado correctamente");
            </script>
            ';// . REDIRECCIONAMIENTO;
        } catch (MailException $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }
}

?>