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
        require_once(VIEWS_PATH . "board.php");
    }

    public function Add ($genre)
    {
        $array = $this->genreRepo->GetAll();
        $flag = 0;
        foreach($array as $valuesArray)
        {
            foreach($valuesArray as  $values)
            {
                if($values->getId() == $genre->getId())
                $flag = 1;
            }
        }
        if ($flag = 0)
            $this->genreRepo->Add($genre);

        $this->showPrincipalView();
    }

    public function Remove ($genre)
    {
        $this->genreRepo->Remove($genre);

        $this->showPrincipalView();
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