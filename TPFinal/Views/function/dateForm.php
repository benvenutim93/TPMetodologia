<div class="col">
            <div class="content-chico">
                <form class="form-signin" action= "<?php echo FRONT_ROOT?>Function/Add" method="POST">
                <h1>FALTA EL LISTADO DE LAS MOVIES QUE NO ESTEN EN FUNCIONES</h1>
                            <!--Cambiar logo -->
                            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">Agregar Funcion</h1>
                            <!--Sacando el sr-only te muestra el titulo(LABEL)-->

                            <!-- L A B E L -->
                            <label for="movi" >Ingrese Pelicula</label>
                            <!--I N P U T-->
                            <select id="inputState" name="nameSalas" class="form-control">
                             <option value="" disabled selected> Seleccione una pelicula </option>

                              <?php foreach($arrayMovieNoRepeatDate as $value){ ?>
                            <option value="<?php echo $value->getId();?>"  > <?php echo $value->getTitle();?></option>
                                <?php } ?>
                            </select>
                            <!-- L A B E L -->
                            <label for="capacity" >Seleccione sala </label>
                            <!--I N P U T-->
                            <select id="inputState" name="nameSalas" class="form-control">
                             <option value="" disabled selected> Seleccione una sala </option>

                              <?php foreach($arrayR as $value){ ?>
                            <option value="<?php echo $value->getId();?>"  > <?php echo $value->getName();?></option>
                                <?php } ?>
                            </select>
                           
                            <label for="" >    </label>
                        <!-- B O T O N -->
                            <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
                </form>

                
            </div>
           
        </div>