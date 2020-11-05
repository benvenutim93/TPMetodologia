<?php

namespace Controllers;

use Models\User as User;
use Models\CreditCard as CreditCard;
use Dao\UserDao as U_DAO;
use Dao\CreditCardDao as CC_DAO;
use Dao\PurchaseDao as P_DAO;

class UserController
{
    private $userRepo;
    private $creditCardDao;
    private $purchaseDao;

  

    public function __construct()
    {
        $this->userRepo = new U_DAO();
        $this->creditCardDao = new CC_DAO();
        $this->purchaseDao = new P_DAO();
    }
    public function showAdminView($msgError = ""){
        require_once(ADMIN_VIEWS . "eleccion.php");

    }

    public function setAdmin($id_userType, $id_user)
    {
        try
        {
            $this->userRepo->modifyUserType($id_userType, $id_user);
            $users = $this->userRepo->GetAll();
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }   
        finally
        {     
            require_once(ADMIN_VIEWS . "usersList.php");
        }
    }

    public function viewSetAdmin ()
    {
        try
        {
            $users = $this->userRepo->GetAll();
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }
        finally
        {
            require_once(ADMIN_VIEWS . "usersList.php"); 
        }
        
    }

    public function showPrincipalView ($msgError = "")
    {
        require_once(USER_VIEWS . "board.php");
        
    }
    public function showModifyView ($msgError = "")
    {
        require_once(USER_VIEWS . "modify-user-form.php");
    }
    
 

    public function addTarjeta($cardHolder,$numberCC,$expiration,$company,$idUser,$cantidad,$idFuncion){
        try
        {  
            $tarjeta = new CreditCard($cardHolder,$numberCC,$expiration,$company);
            $this->creditCardDao->Add($tarjeta,$idUser);
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }

        $cardsList = $this->creditCardDao->GetAll($idUser);
    
        require_once(USER_VIEWS . "tarjeta-compra-form.php");
 
    }

    public function login ($mail, $password)
    {
        try
        {
            $array = $this->userRepo->GetOneMail($mail);
            $flag =0 ;
            foreach($array as $user){

                if ($user["mail"] == $mail && password_verify($password,$user["pass"] ))
                { 
                    if($user["id_userType"]== 2){
                    $flag =1;
                    $_SESSION["logged"]=$user;
                    $this->showPrincipalView();
                    }  
                    if($user["id_userType"]== 1){
                        $flag =1;
                        $_SESSION["logged"]=$user;
                        $this->showAdminView();
                    }
                }
            }
            if($flag == 0){
                    $msgError = array( "description" => "Datos incorrectos. Intente nuevamente o registrese en el sistema",
                    "type" => 1);
                    $this->showLoginView($msgError);
            }
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showLoginView();
        }
    }

  
    public function showSingInFormView()
    {
        require_once(USER_VIEWS . "signIn.php");
    }

    public function showLoginView ($msgError = "")
    {
        require_once(USER_VIEWS . "login-form.php");
    }

    public function showLogOutView()
    {   
        session_destroy();
        require_once(USER_VIEWS . "logOutView.php");
    }
    public function userNameExists ($userName)
    {
        try
        {
            $array = $this->userRepo->GetAll();

            foreach ($array as $user)
            {
                if($user["userName"] == $userName)
                    return true;
            }
            return false;
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showLoginView();
        }
    }

    public function verificar_mod_user ($userName,$id)
    {
        try
        {
            $array = $this->userRepo->GetAll();

            foreach ($array as $user)
            {
                if($user["userName"] == $userName && $user["id_user"] != $id)
                    return true;
            }
            return false;
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showLoginView();
        }
    }
    public function verificar_mod_mail ($mail,$id)
    {
        try
        {
            $array = $this->userRepo->GetAll();

            foreach ($array as $user)
            {
                if($user["mail"] == $mail && $user["id_user"] != $id)
                    return true;
            }
            return false;
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showLoginView();
        }
    }
    public function modify($firstname,$lastName,$userName,$mail,$id_user){

        try
        {
            if(!$this->verificar_mod_user($userName,$id_user)){
                
            if(!$this->verificar_mod_mail($mail,$id_user)){
                $this->userRepo->Modify($firstname,$lastName,$userName,$mail,$id_user);
                    $aux = $this->userRepo->getOneMail($mail);
                    $_SESSION["logged"] = $aux[0];
                    $msgError = array( "description" => "Se modifico con exito el Perfil.",
                    "type" => 2);  
                    $this->showPrincipalView($msgError);
            }else{
                $msgError = array( "description" => "El mail  ya esta en uso.",
                    "type" => 3);  
                $this->showModifyView($msgError);
            }        
            }
            else{
                        $msgError = array( "description" => "El Nombre de Usuario ya esta en uso.",
                    "type" => 3);  
                        $this->showModifyView($msgError);
            }
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showPrincipalView();
        }
    }



    public function signIn ($firstName = "", $lastName = "", $userName = "", $pass = "", $mail = "", $dni = "", $birthDate = "", $userType = "")
    {
        try
        {
            if ($this->userNameExists($userName))
                $this->showSingInFormView();
            else 
            {
                $user = new User($firstName, $lastName, $userName, $pass, $mail, $dni, $birthDate, $userType);
                $this->userRepo->Add($user);
                $msgError = array( "description" => "El usuario se agrego con éxito",
                    "type" => 3);
                $this->showLoginView($msgError);
            }
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showLoginView();
        }
    }

    public function Remove ($userName)
    {
            $this->userRepo->Remove($userName);

            $this->showListUsersView();
    }

    public function showListUsersView()
    {
        require_once(USER_VIEWS . "userList.php");
    }

    public function viewProfile ($id_user)
    {   
        $user = $this->userRepo->GetOne($id_user);
        $this->showListUsersView();
    }   
   public function showPurchaseView($idUser){
 
       $purchaseList = $this->purchaseDao->getAllPurchase($idUser);
       require_once(PURCHASE_VIEWS . "purchase-view.php");
   }


}


?>