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

    public function showPrincipalView ()
    {
        require_once(USER_VIEWS . "board.php");
    }

    public function login ($mail, $password)
    {
        $array = $this->userRepo->GetAll();
        foreach ($array as $user)
        {
            if ($user["mail"] == $mail && $user["pass"] == $password)
            {
                $_SERVER["logged"] = $user;
                $this->showPrincipalView();
            }
        }
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

    public function showSingInFormView()
    {
        require_once(FRONT_ROOT . "signIn.php");
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



    public function signIn ($name = "", $lastName = "", $userName = "", $pass = "", $mail = "", $dni = "", $birthDate = "")
    {
        if ($this->userNameExists($userName))
            $this->showSingInFormView();
        else 
        {
            $user = new User($name, $lastName, $userName, $pass, $mail, $dni, $birthDate);
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