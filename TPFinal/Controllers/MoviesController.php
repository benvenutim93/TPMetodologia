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

    public function showSearchMovieView()
    {
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

    public function searchMovie ($title)
    {
        echo "llego aca";
    }
}


?>