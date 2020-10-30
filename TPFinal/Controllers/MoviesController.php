<?php
namespace Controllers;

use Models\Movie as Movie;
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
        $genresXmovie = $this->genreDao->GetGenresXmovies();
        if (!$genresXmovie)
            $this->setGenresToMovies();
        
    }

    public function showSearchMovieView()
    {
        $pelisDates = $this->fechasPelis();
        $genres = $this->genreDao->GetAll();
        require_once(VIEWS_PATH . "searchMovie.php");
    }

    public function showMoviesListView()
    {
        $moviesList = array();
        $moviesList = $this->moviesDao->getMoviesFunctions();

        if ($moviesList)
            require_once(USER_VIEWS . "moviesView.php");
        else
        {           
            echo '<script>
                    alert("No hay funciones por el momento");
                    </script>';
            require_once(USER_VIEWS . "login-form.php");
        }
    }

    public function showOnlyMovie($moviesList)
    {
        $genreRepo = $this->genreDao->GetAll();
        require_once(USER_VIEWS. "moviesView.php");
    }

    public function showMoviesSearch($moviesList)
    {
        require_once(USER_VIEWS. "movieViewSearch.php");
    }


    public function searchMovieTitle ($title)
    {
        $movie = $this->moviesDao->GetWithFunction($title);

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


    public function searchMovieGenre($genre_id)
    {

        $moviesList = $this->moviesDao->GetWithFunctionGenres();
        
        
        if (!empty($moviesList))
            $this->showMoviesSearch($moviesList);
        else
        {
            echo '<script>
                    alert("No se encontraron peliculas con ese género");
                    </script>';
            $this->showSearchMovieView();
            
        }
       

    }

    public function searchMovieDate($date){ //año - mes - dia
        $moviesList = $this->moviesDao->GetMoviesfunctionDate($date);        


            if ($moviesList)
                $this->showMoviesSearch($moviesList);
            else
            {
                echo '<script>
                        alert("No se encontraron peliculas en esa fecha");
                        </script>';
                $this->showSearchMovieView();
                
            }
       

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

    public function setGenresToMovies()
    {
        $movies = $this->moviesDao->retrieveAPIJson();

        foreach($movies as $value)
        {
            $movie = $this->moviesDao->GetOneName($value["title"]);
            
            foreach($value["genre_ids"] as $id)
            {   
                foreach($movie as $aux)
                    $this->genreDao->addGenreToMovie($aux["id_movie"], $id);
            }
        }
    } 
}

?>