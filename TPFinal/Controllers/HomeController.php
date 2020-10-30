<?php
  namespace Controllers;

  use DAO\MovieDao as M_DAO;
  use DAO\CinemaDao as C_DAO;

  use Models\Cinema as Cinema;
  use Models\Movie as Movie;

  class HomeController
  { 
      private $movieDao;
      private $cinemaDao;

      public function __construct()
      {
          $this->movieDao = new M_DAO();
          $this->cinemaDao = new C_DAO();
      }

      public function Index()
      {
          $pelis = $this->movieDao->retrieveUpcoming();
            #paso cines Existentes
          $cines = $this->cinemaDao->GetALL();
          require_once(VIEWS_PATH."prueba2.php");
      }
  }
?>