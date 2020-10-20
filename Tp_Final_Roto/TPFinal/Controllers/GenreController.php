<?php
namespace Controllers;

use Models\Genre as Genre;
use Repository\GenreRepository as G_Repo;

class GenreController 
{
    private $genreRepo;

    public function __construct()
    {
        $this->genreRepo = new G_Repo();
    }

    public function showPrincipalView ()
    {
        require_once(USER_VIEWS . "board.php");
    }


    public function GetAll ()
    {
        $array = $this->genreRepo->GetAll();
        return $array[0];
    }

    public function GetOne ($name)
    {
        return $this->genreRepo->GetOne($name);
    }
}


?>