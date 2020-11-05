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
        try
        {
            $genresXmovie = $this->genreDao->GetGenresXmovies();
            if (!$genresXmovie)
                $this->setGenresToMovies();
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }
        
    }

    public function showSearchMovieView($msgError = "")
    {
        try
        {
            $pelisDates = $this->fechasPelis();
            $genres = $this->genreDao->GetAll();
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
        }
        finally
        {
            require_once(VIEWS_PATH . "searchMovie.php");
        }
    }

    public function showMoviesListView()
    {
        try{    
            $moviesList = array();
            $moviesList = $this->moviesDao->getMoviesFunctions();

            if ($moviesList)
                require_once(USER_VIEWS . "moviesView.php");
            else
            {      
                $msgError = array( "description" => "No hay funciones por el momento",
                    "type" => 3);     
                require_once(USER_VIEWS . "login-form.php");
            }
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            require_once(USER_VIEWS . "login-form.php");
        }
    }

    public function showOnlyMovie($moviesList)
    {
        try
        {
            $genreRepo = $this->genreDao->GetAll();
            require_once(USER_VIEWS. "moviesView.php");
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            require_once(USER_VIEWS . "login-form.php");
        }
    }

    public function showMoviesSearch($moviesList)
    {
        require_once(USER_VIEWS. "movieViewSearch.php");
    }


    public function searchMovieTitle ($title)
    {
        try
        {
            $movie = $this->moviesDao->GetWithFunction($title);

            if ($movie)
            $this->showMoviesSearch($movie);
            else
            {
                $msgError = array( "description" => "No se encontraron peliculas con ese titulo",
                    "type" => 1); 
                $this->showSearchMovieView($msgError);
                
            }
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showSearchMovieView();
        }
    }


    public function searchMovieGenre($genre_id)
    {
        try
        {
            $moviesList = $this->moviesDao->GetWithFunctionGenres();
            
            
            if (!empty($moviesList))
                $this->showMoviesSearch($moviesList);
            else
            {
                $msgError = array( "description" => "No se encontraron peliculas con ese género",
                "type" => 1); 
                $this->showSearchMovieView($msgError);    
            }
        }
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            $this->showSearchMovieView();
        }
       

    }

    public function searchMovieDate($date){ //año - mes - dia

        try{
            $moviesList = $this->moviesDao->GetMoviesfunctionDate($date);        


            if ($moviesList)
                $this->showMoviesSearch($moviesList);
            else
            {
                $msgError = array( "description" => "No se encontraron peliculas en esa fecha",
                "type" => 1); 
                $this->showSearchMovieView($msgError);
                
            }
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
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
        try
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
        catch (\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            require_once(USER_VIEWS . "login-form.php");
        }
    } 

    public function showFunctionView(){
        try{    
            $moviesList = array();
            $moviesList = $this->moviesDao->getFunctionNoRepeat(); 

            if ($moviesList)
                require_once(USER_VIEWS . "functionsView.php");
            else
            {           
                $msgError = array( "description" => "No hay funciones por el momento",
                "type" => 1);
                require_once(USER_VIEWS . "board.php");
            }
        }
        catch(\PDOException $ex)
        {
            $msgError = array( "description" => "Error de conexión con la base de datos. Intente nuevamente",
            "type" => 1);
            require_once(VIEWS_PATH . "errorView.php");
            require_once(USER_VIEWS . "board.php");
        }
    }
}

?>