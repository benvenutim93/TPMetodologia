<?php

namespace Controllers;

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
        require_once(VIEWS_PATH."board.php");
    }

    public function login ($mail, $password)
    {
        $array = $this->userRepo->GetAll();
        foreach ($array as $user)
        {
            if ($user->getMail() == $mail && $user->getPassword() == $password)
            {
                $this->showPrincipalView();
            }
        }
    }
}


?>