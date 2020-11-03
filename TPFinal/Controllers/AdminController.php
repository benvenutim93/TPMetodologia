<?php
namespace Controllers;

Use Models\Admin as Admin;
Use Models\Cinema as Cinema;
Use DAO\UserDao as A_Repo;


class AdminController
{


    public function showPrincipalView ($msgError = "")
    {
        require_once(ADMIN_VIEWS . "eleccion.php");
    }
    
    public function showOPAdminsView($msgError = "")
    {
        require_once(ADMIN_VIEWS . "boardAdmin.php");
    }
    public function showOPUsersView($msgError = "")
    {
        require_once(USER_VIEWS . "board.php");
    }

    public function loginForm ($msgError = "")
    {
        require_once(ADMIN_VIEWS . "adminLogIn.php");
    }

    public function login($mail,$pass)
    {
        
        $repo = new A_Repo();
        $array = $repo->GetOneMail($mail);
        foreach($array as $value)
        {
            if($value["pass"]== $pass && $value["mail"]== $mail && $value["id_userType"] == 1)
            {
                $_SERVER["logger"]=$value;
               $this->showPrincipalView();
            }
        }

    }
}
?>