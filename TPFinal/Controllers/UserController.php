<?php

namespace Controllers;

use Models\User as User;
use Repository\UserRepository as U_Repo;

class UserController
{
    private $userRepo;

    public function __construct()
    {
        $this->userRepo = new U_Repo();
    }

    public function showPrincipalView ()
    {
        require_once(VIEWS_PATH . "board.php");
    }

    public function login ($mail, $password)
    {
        $array = $this->userRepo->GetAll();
        foreach ($array as $user)
        {
            if ($user->getMail() == $mail && $user->getPass() == $password)
            {
                $this->showPrincipalView();
            }
        }
    }

    public function userNameExists ($userName)
    {
        $array = $this->userRepo->GetAll();

        foreach ($array as $user)
        {
            if($user->getUserName() == $userName)
                return true;
        }
        return false;
    }

    public function showSingInFormView()
    {
        require_once(VIEWS_PATH . "signIn.php");
    }

    public function showLoginView ()
    {
        require_once(VIEWS_PATH . "login-form.php");
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
        $usersList = $this->userRepo->GetAll();
        require_once(VIEWS_PATH . "userList.php");
    }


}


?>