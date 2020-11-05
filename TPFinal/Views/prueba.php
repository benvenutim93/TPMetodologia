<div class="content-xxl">
<h2 class="text-center"> <font color="black"> Buscador de peliculas</font></h1>
<div class="row">
<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>Movies/searchMovieTitle" method="GET">
        <div>
            <h2 class="text-center">Nombre</h1>
            <label for="titleSearch">Ingrese Titulo de la Pelicula</label>
            <input type= "text"id="titleSearch"  class="form-control" name="title" placeholder="Titulo Película" required>
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>



<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>Movies/searchMovieGenre" method="POST">
        <div>
            <h2 class="text-center"> Genero</h1>
            <div class="form-group col-md-12">
                    <label for="inputState">Seleccione Genero </label>
                    <select id="inputState" name="nameGenre" class="form-control">
                    <option value="" disabled selected> Seleccione uno </option>

                        <?php foreach($genreRepo as $genre){ ?>
                            <option value="<?php echo $genre["id_genre"];?>"  > <?php echo $genre["genreName"];?></option>
                        <?php } ?>

                    </select>
          </div>
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>


<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>Movies/searchMovieDate" method="GET">
        <div>
        <h2 class="text-center"> Fecha</h1>
            <label for="titleSearch">Ingrese Fecha</label>
            <input type="date" id="date" class="form-control" placeholder="Fecha"  min=<?php echo date("Y-m-d")?> name="date" required>
            
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>
</div>
</div>