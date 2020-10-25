
            <div class="content-chico">
                <form class="form-signin" action= "<?php echo FRONT_ROOT?>Function/Add" method="POST">
                <h1>Falta hacer funcion Add FunctionController</h1>
                            <!--Cambiar logo -->
                            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">Agregar Funcion</h1>
                      

                  
                            <label for="movi" >Ingrese Pelicula</label>
                            <h2>Muestra pelis que estan en funciones (repite peliculas despues de ingresar una)</h2>
                            <!--I N P U T-->
                            <select id="inputState" name="movie" class="form-control">
                             <option value="" disabled selected> Seleccione una pelicula </option>

                              <?php foreach($arrayMovieNoRepeatDate as $value){ ?>
                            <option value="<?php echo $value->getId();?>"  > <?php echo $value->getTitle();?></option>

                                <?php } ?>
                            </select>
                     
                            <label for="room" >Seleccione sala </label>
                            <!--I N P U T-->
                            <select id="inputState" name="room" class="form-control">
                             <option value="" disabled selected> Seleccione una sala </option>

                              <?php foreach($arrayR as $value){ ?>
                            <option value="<?php echo $value->getId();?>"  > <?php echo $value->getName();?></option>
                                <?php } ?>
                            </select>

                            <label for="seatsOcupped">Sacar despues(ocultar inputs)</label>
                            <!--I N P U T-->
                            <input type="number" id="seatsOcupped" class="form-control"  name="seatsOcupped"   value="0" readonly>
                            <label for="date">Sacar despues(ocultar inputs)</label>
                            <!--I N P U T-->
                            <input type="text" id="date" class="form-control"  name="date"   value="<?php echo $fecha;?>" readonly>
                           
                            <label for="" >    </label>

                        <!-- B O T O N -->
                            <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
                </form>

                
            </div>
           
