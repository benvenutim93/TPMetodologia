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
        $movie = $this->moviesDao->GetWithFunction($title);
        $i = 0;
        foreach($movie as $value)
        {
            $ids = explode("/", $value["genre_ids"]);
            $value["genre_ids"] = $ids;
            $movie[$i] = $value;
            $i++;
        }
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

        $movie = $this->moviesDao->GetWithFunctionGenres();
        
        $moviesList = array();

        foreach ($movie as  $value)
        {
            foreach($value->getGenre_ids() as $id)
            {    
                if($id == $genre_id){
                   array_push($moviesList,$value);
                }     
            }                   
        }
       $this->showMovieArray($moviesList);

    }

    public function searchMovieDate($date){ //año - mes - dia
        $array = $this->moviesDao->getMoviesFunctions();        
        $moviesList=array(); 
        

            foreach($array as $value){
                if ($value["functionDate"] == $date)
                {
                    $movie = new Movie();
                    $movie->setTitle($value["title"]);
                    $movie->setOverview($value["overview"]);
                    $movie->setOriginal_language($value["original_language"]);
                    $movie->setVote_average($value["vote_average"]);
                    $movie->setAdult($value["adult"]);
                    $movie->setPopularity($value["popularity"]);
                    $movie->setPoster_path($value["poster_path"]);
                    $ids = explode("/",$value["genre_ids"]);
                    $movie->setGenre_ids($ids);

                    array_push($moviesList, $movie);
                }  
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
        }
        $nonRepeat = array_unique($dates);
       return $nonRepeat;
    }


 
}


?>