<?php
namespace Controllers;

use Models\Genre as Genre;
use DAO\GenreDAO as G_DAO;

class GenreController 
{
    private $genreDao;

    public function __construct()
    {
        $this->genreDao = new G_DAO();

    }

    public function showPrincipalView ()
    {
        require_once(USER_VIEWS . "board.php");
    }


    public function GetAll ()
    {
        return $this->genreDao->retrieveAPIJson();
       
    }
}