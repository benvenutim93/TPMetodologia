<?php
include_once("header.php");
include_once("nav.php");
?>
<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>searchMovie" method="GET">
        <div>
            <h2 class="text-center"> Buscador de peliculas</h1>
            <label for="titleSearch">Ingrese Titulo de la Pelicula</label>
            <input type= "text"id="titleSearch"  class="form-control" name="title" placeholder="Titulo Película" required>
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>

<?php
include_once("footer.php");
?>