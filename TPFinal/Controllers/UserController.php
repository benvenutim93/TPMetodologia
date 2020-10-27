<?php

namespace Controllers;

use Models\User as User;
use Dao\UserDao as U_DAO;

class UserController
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new U_DAO();
    }
    public function showAdminView(){
        require_once(ADMIN_VIEWS . "eleccion.php");

    }

    public function showPrincipalView ()
    {
        require_once(USER_VIEWS . "board.php");
    }
    public function showModifyView ()
    {
        require_once(USER_VIEWS . "modify-user-form.php");
    }


    public function login ($mail, $password)
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
                $this->showLoginView();
        }
    }

  
    public function showSingInFormView()
    {
        require_once(USER_VIEWS . "signIn.php");
    }

    public function showLoginView ()
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
        $array = $this->userRepo->GetAll();

        foreach ($array as $user)
        {
            if($user["userName"] == $userName)
                return true;
        }
        return false;
    }

    public function verificar_mod_user ($userName,$id)
    {
        $array = $this->userRepo->GetAll();

        foreach ($array as $user)
        {
            if($user["userName"] == $userName && $user["id_user"] != $id)
                return true;
        }
        return false;
    }
    public function verificar_mod_mail ($mail,$id)
    {
        $array = $this->userRepo->GetAll();

        foreach ($array as $user)
        {
            if($user["mail"] == $mail && $user["id_user"] != $id)
                return true;
        }
        return false;
    }
    public function modify($firstname,$lastName,$userName,$mail,$id_user){

        if(!$this->verificar_mod_user($userName,$id_user)){
            
          if(!$this->verificar_mod_mail($mail,$id_user)){
             $this->userRepo->Modify($firstname,$lastName,$userName,$mail,$id_user);
                $aux = $this->userRepo->getOneMail($mail);
                $_SESSION["logged"] = $aux[0];
                echo '<script>
                    alert("Se modifico con exito el Perfil.");
                    </script>';
                $this->showPrincipalView();
          }else{
            echo '<script>
            alert("El mail  ya esta en uso.");
            </script>';
            $this->showModifyView();
          }
               

        }
        else{
            
            echo '<script>
                    alert("El Nombre de Usuario ya esta en uso.");
                    </script>';
                    $this->showModifyView();
        }


    }



    public function signIn ($firstName = "", $lastName = "", $userName = "", $pass = "", $mail = "", $dni = "", $birthDate = "", $userType = "")
    {
        if ($this->userNameExists($userName))
            $this->showSingInFormView();
        else 
        {
            $user = new User($firstName, $lastName, $userName, $pass, $mail, $dni, $birthDate, $userType);
            $this->userRepo->Add($user);
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


}


?>