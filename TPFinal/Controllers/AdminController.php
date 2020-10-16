<?php
namespace Controllers;

Use Models\Admin as Admin;
Use Models\Cinema as Cinema;
Use Repository\AdminReposiToRy as A_Repo;
Use Repository\CinemaRepository as C_Repo;

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
}
?>