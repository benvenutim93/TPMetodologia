<?php
namespace Controllers;

Use Models\Admin as Admin;
Use Models\Cinema as Cinema;
Use Repository\AdminReposiToRy as A_Repo;
Use Repository\CinemaRepository as C_Repo;

use Librerias\PHPMailer as PHPMailer;
use Librerias\Exception as Exception;

class AdminController
{


    public function showPrincipalView ()
    {
        require_once(ADMIN_VIEWS . "eleccion.php");
    }
    
    public function showOPAdminsView()
    {
        require_once(ADMIN_VIEWS . "boardAdmin.php");
    }
    public function showOPUsersView()
    {
        require_once(USER_VIEWS . "board.php");
    }

    public function loginForm ()
    {
        require_once(ADMIN_VIEWS . "adminLogIn.php");
    }

    public function login($mail,$pass){

        $repo= new A_Repo();
        $array=$repo->GetALL();

        foreach($array as $value)
        {
            if($value->getpass()== $pass && $value->getMail()== $mail && $value->getIsAdmin()== true)
            {
                $_SERVER["logger"]=$value;
               $this->showPrincipalView();
            }
        }

    }

    // TEMPORAL DESPUES SE HACE AUTOMATICO
    public function mail(){

        $mail = new PHPMailer(true);

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
                
                  //  $mail->addAddress('benvenutim93@gmail.com', 'Marian');               // mail / nombre
                    $mail->addAddress('lautarofullone@gmail.com', 'Lauta crack');       // mail / nombre
                // $mail->addAddress('ropeque19@hotmail.com', 'Rodri');               // mail / nombre
                  //  $mail->addAddress('nicolas-jbo3@hotmail.com', 'Nico');               // mail / nombr

                //
                $html="<h1>Estoy probando La libreria PHPMailer para mandar el mail</h1>
                <p>probando desde el tpfinal</p>
                <h2><b>Avisame por wpp si te llego el mail.</b></h2>
                <p>&copy;<strong> Los supervivientes</strong> -2020</p>
                ";
                    // Content
                    $mail->isHTML(true);                                  // Set email fo
                    $mail->Subject = 'Asunto pruebita de mail con PHPMailer';// Asunto
                    $mail->Body    = $html;                      //Body del mail
             
                $mail->send();
             
                    echo '<script>
                    alert("El mensaje fue enviado correctamente");
                    </script>
                    '.$this->showOPAdminsView();
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }




    }


}
?>