
<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>Movies/searchMovieTitle" method="GET">
        <div>
            <h2 class="text-center"> Buscador de peliculas</h1>
            <label for="titleSearch">Ingrese Titulo de la Pelicula</label>
            <input type= "text"id="titleSearch"  class="form-control" name="title" placeholder="Titulo Película" required>
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>



<div class="content-login">
    <form action= "<?php echo FRONT_ROOT?>Movies/searchMovieGenre" method="POST">
        <div>
            <h2 class="text-center"> Buscador de peliculas</h1>
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
            <h2 class="text-center"> Buscador de peliculas</h1>
            <label for="titleSearch">Ingrese Fecha</label>
                <select id="inputState" name="year" class="form-control">
                        <option value="" disabled selected> Seleccione uno </option>
                        <?php
                             foreach($pelisDates as $date){ ?>
                                <option value="<?php echo $date;?>"  > <?php echo $date;?></option>
                            <?php } ?>

                </select>
            
        </div>
         <button class="btn btn-lg btn-info " type="submit">Buscar</button>
    </form>
</div>
