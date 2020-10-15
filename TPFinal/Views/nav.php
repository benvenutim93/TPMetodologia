<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
   <!-- BIENVENIDO -->
  <strong> <a class="navbar-brand" href="<?php echo FRONT_ROOT ;?>">Los supervivientes</a> </strong>  
  <span class="navbar-brand">Bienvenido</span>
 

  <div class="collapse navbar-collapse" >
    <ul class="navbar-nav mr-auto">
       <!-- LISTADO -->
      <li class="nav-item ">
        <a class="nav-link" href= "<?php echo FRONT_ROOT?>Movies/showMoviesListView">Cartelera</a>
      </li>
      <!-- LISTADO -->
      <li class="nav-item ">
        <a class="nav-link" href="<?php echo FRONT_ROOT?>Movies/showSearchMovieView">Buscar película</a>
      </li>
    </ul>
    <a class="nav-link" href="<?php echo FRONT_ROOT?>User/showLogOutView">Cerrar Sesion</a>
    <a class="nav-link" href="<?php echo FRONT_ROOT?>User/showLoginView">Iniciar Sesion</a>


  </div>
</nav>
