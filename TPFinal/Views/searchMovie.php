<?php
include_once("header.php");
include_once("nav.php");
?>

<form action= "<?php FRONT_ROOT?>searchMovie" method="GET">
<div>
    <label for="titleSearch">Ingrese Titulo de la Pelicula</label>
    <input type= "text"id="titleSearch" name="title" placeholder="Titulo Película" required>
</div>
<button type="submit">Buscar</button>
</form>
<?php
include_once("footer.php");
?>