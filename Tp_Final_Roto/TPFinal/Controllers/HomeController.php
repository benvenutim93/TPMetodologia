<?php
    namespace Controllers;

    class HomeController
    {
        public function Index($message = "")
        {
            require_once(USER_VIEWS."login-form.php");
        }        
    }
?>