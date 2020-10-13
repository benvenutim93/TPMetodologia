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
        require_once(VIEWS_PATH . "eleccion.php");
    }
    public function showCinemaForm()
    {
        require_once(VIEWS_PATH. "cinema-form.php");
    }
    public function showOPAdminsView()
    {
        require_once(VIEWS_PATH . "boardAdmin.php");
    }
    public function showOPUsersView()
    {
        require_once(VIEWS_PATH . "board.php");
    }

    public function loginForm ()
    {
        require_once(VIEWS_PATH . "adminLogIn.php");
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
    public function registerCinema($name,$address,$capacity,$ticketValue){
        $repo= new C_Repo();
        $cinema= new Cinema($name,$address,$capacity,$ticketValue);
        $repo->Add($cinema);
        $this->showOPAdminsView();
    }
}
?>