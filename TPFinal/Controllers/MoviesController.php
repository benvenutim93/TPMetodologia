<?php
namespace Controllers;

use Models\Movie as Movie;
use Models\Genre as Genre;
use DAO\MovieDao as M_DAO;
use DAO\GenreDAO as G_DAO;

class MoviesController
{
    private $moviesDao;
    private $genreDao;
    

    public function __construct()
    {
        $this->moviesDao = new M_DAO();
        $this->genreDao = new G_DAO();
    }

    public function showSearchMovieView()
    {
        $genreRepo = $this->genreDao->GetAll();
        $pelisDates = $this->fechasPelis();
        require_once(VIEWS_PATH . "searchMovie.php");
    }

    public function showMoviesListView()
    {
        /*$moviesList = $this->moviesDao->retrieveAPIJson();*/
        $genreRepo = $this->genreDao->retrieveAPIJson();
        $moviesList = array();
        $movies = $this->moviesDao->getMoviesFunctions();
        foreach ($movies as $peli)
        {
            $ids = explode("/", $peli["genre_ids"]);
            $peli["genre_ids"] = $ids;
            array_push($moviesList, $peli);
        }
        require_once(USER_VIEWS . "moviesView.php");
    }

    public function showOnlyMovie($moviesList)
    {
        $genreRepo = $this->genreDao->GetAll();
        require_once(USER_VIEWS. "moviesView.php");
    }

    public function showMoviesSearch($moviesList)
    {
        $genreRepo = $this->genreDao->GetAll();
        require_once(USER_VIEWS. "movieViewSearch.php");
    }


    public function searchMovieTitle ($title)
    {
        $movie = $this->moviesDao->GetOneName($title);
        $peli = $movie[0];
        $ids = explode("/", $peli["genre_ids"]);
        $peli["genre_ids"] = $ids;
        $movie[0] = $peli;


        if ($movie)
           $this->showMoviesSearch($movie);
        else
        {
            echo '<script>
                    alert("No se encontraron peliculas con ese titulo");
                    </script>';
            $this->showSearchMovieView();
            
        }
        
    }

    public function showMovieArray($movilist)
    {
       $moviesList = $movilist;
      
        require_once(USER_VIEWS . "moviesViewArray.php");
    }

    public function searchMovieGenre($genre_id)
    {

        $movies = $this->moviesDao->GetAll();

        $aux = array();
        $moviesList = array();

        foreach ($movies as  $value)
        {
            foreach($value->getGenre_ids() as $id)
            {
                
                
                if($id == $genre_id){
                    $aux=$this->genreDao->GetOneName($this->genreDao, $id);
                    array_push($moviesList,$value);
                   $value->setGenre_ids($aux);
                }
                  
            }
            
            
                  
        }
   

       $this->showMovieArray($moviesList);
        
        
       

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

       $this->showMovieArray($moviesList);

    } 
    public function fechasPelis()
    {
   
        $moviesList = $this->moviesDao->GetAll();
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