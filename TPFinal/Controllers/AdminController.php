<?php
namespace Controllers;

class AdminController
{


    public function loginForm ()
    {
        require_once(VIEWS_PATH . "adminLogIn.php");
    }
}


?>