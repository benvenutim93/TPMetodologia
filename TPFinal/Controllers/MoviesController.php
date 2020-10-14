<?php
namespace Controllers;

use Models\Movie as Movie;
use Repository\MoviesRepository as M_Repo;
use Repository\GenreRepository as G_Repo;

class MoviesController
{
    private $moviesDao;


    public function __construct()
    {
        $this->moviesDao = new M_Repo();
    }

    public function showMoviesListView()
    {
        $moviesList = $this->moviesDao->GetAll();
        $genreRepo = new G_Repo();
        require_once(VIEWS_PATH . "moviesView.php");
    }

    public function showOnlyMovie($moviesList)
    {
        $genreRepo = new G_Repo();
        require_once(VIEWS_PATH . "moviesView.php");
    }

    public function showSearchMovieView()
    {
        $genreRepo = new G_Repo();
        $genreRepo = $genreRepo->GetAll();
        $pelisDates = $this->fechasPelis();
        require_once(VIEWS_PATH . "searchMovie.php");
    }


    public function Add ($video, $adult, $original_language, $original_title, $genre_id, $title, $overview, $release_date)
    {
        $flag = 0;
        $array = $this->moviesDao->GetAll();

        foreach ($array as $movie)
        {
            if ($movie->getTitle() == $title)
            {
                $flag = 1;
            }
        }

        if ($flag == 0)
        {
            $peli = new Movie();
            $peli->setVideo($video);
            $peli->setAdult($adult);
            $peli->setOriginal_language ($original_language);
            $peli->setGenre_ids($genre_id);
            $peli->setOriginal_title($original_title);
            $peli->setOverview($overview);
            $peli->setTitle ($title);
            $peli->setRelease_date($release_date);

            $this->moviesDao->Add($peli);
        }

        $this->showMoviesListView();

    }

    public function searchMovieTitle ($title)
    {
        $array = $this->moviesDao->GetAll();
        $flag = false; $moviesList=array();

           foreach($array as $movie)
           {
               if ($movie->getTitle() == $title)
               {
                    $flag = true;
                    array_push($moviesList, $movie);                    
                    $this->showOnlyMovie($moviesList);
               }  
           }
        
        if ($flag == false)
        {
            $this->showSearchMovieView();
            
        }
    }

    public function searchMovieGenre($nameGenre)
    {
        $array = $this->moviesDao->GetAll();
        $genres = new G_Repo(); $flag=false; $id=null;
        $arrayGenres = $genres->GetAll();

        foreach($arrayGenres as $genre){
            if($genre->getName() == $nameGenre){
                $flag = true;
                $id= $genre->getId();
            }
        }

        $moviesList=array();

           foreach($array as $movie)
           {
               foreach($movie->getGenre_ids() as $genre){
                if($genre == $id){
                    array_push($moviesList, $movie);
                }
               }

           }
           $this->showOnlyMovie($moviesList);
        
        if ($flag == false)
        {
            $this->showSearchMovieView();
            
        }

    }

    public function searchMovieDate($year){ //año - mes - dia
        $array = $this->moviesDao->GetAll();
        $moviesList=array(); 

     

            foreach($array as $movie){
                $date = $movie->getRelease_date();

                $fecha = explode('-', $date);
                $años = array_shift($fecha);
                
                
                if($años == $year){
                    array_push($moviesList, $movie);
                }

                /* Muestra por fecha especifica
                if ($date == $year){
                    array_push($moviesList, $movie);
                 }*/
                
            }

       $this->showOnlyMovie($moviesList);

    } 
    public function fechasPelis(){

        $repom= new M_Repo();
        $moviesList = $repom->GetAll();
        $dates= array();

        foreach($moviesList as $movie){ 
            $date = $movie->getRelease_date();

            
            $fecha = explode('-', $date);
            $años = array_shift($fecha);
            
            array_push($dates,$años);
            //array_push($dates, $date); Muestra por fecha especifica
        }
        $nonRepeat = array_unique($dates);
       return $nonRepeat;
    }
}


?>