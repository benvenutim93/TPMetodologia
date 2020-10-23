<?php
namespace Controllers;

use Models\Movie as Movie;
use Repository\MoviesRepository as M_Repo;
use Repository\GenreRepository as G_DAO;

class MoviesController
{
    private $moviesDao;
    private $genreDao;
    

    public function __construct()
    {
        $this->moviesDao = new M_Repo();
        $this->genreDao = new G_DAO();
    }



    public function showMoviesListView()
    {
        $moviesList = $this->moviesDao->GetAll();
        $genreRepo = $this->genreDao->GetAll();
        
        require_once(USER_VIEWS . "moviesView.php");
    }

    public function showOnlyMovie($moviesList)
    {
        $genreRepo = $this->genreDao->GetAll();
        require_once(USER_VIEWS . "moviesView.php");
    }

    public function showSearchMovieView()
    {
        $genreRepo = $this->genreDao->GetAll();
        $pelisDates = $this->fechasPelis();
        require_once(VIEWS_PATH . "searchMovie.php");
    }


    public function searchMovieTitle ($title)
    {
        $array = $this->moviesDao->GetAll();
        $flag = false; $moviesList=array();

           foreach($array as $movie)
           {
               if ($movie["title"] == $title)
               {
                    $flag = true;
                    array_push($moviesList, $movie);                    
                    $this->showOnlyMovie($moviesList);
               }  
           }
        
        if ($flag == false)
        {
            echo '<script>
                    alert("No se encontraron peliculas con ese titulo");
                    </script>';
            $this->showSearchMovieView();
            
        }
    }

    public function searchMovieGenre($nameGenre)
    {
        $array = $this->moviesDao->GetAll();
        $genresJson = $this->genreDao->GetAll(); 
        $flag=false; $id=null;
        

        foreach($genresJson as $genre){
            if($genre["name"] == $nameGenre){
                $flag = true;
                $id= $genre["id"];
            }
        }

        $moviesList=array();

           foreach($array as $movie)
           {
               foreach($movie["genre_ids"] as $genre){
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
                $date = $movie["release_date"];

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

        
        $moviesList = $this->moviesDao->GetAll();
        $dates= array();

        foreach($moviesList as $movie){ 
            $date = $movie["release_date"];
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