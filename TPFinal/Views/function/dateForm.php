
            <div class="content-chico">
                <form class="form-signin" action= "<?php echo FRONT_ROOT?>Function/Add" method="POST">
                            <!--Cambiar logo -->
                            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">Agregar Funcion</h1>
                      

                  
                            <label for="movi" >Ingrese Pelicula</label>
                            
                            <!--I N P U T-->
                            <select id="inputState" name="movie" class="form-control">
                             <option value="" disabled selected> Seleccione una pelicula </option>

                              <?php foreach($arrayAmostrar as $value){ ?>
                            <option value="<?php echo $value["id_movie"];?>"> <?php echo $value["title"];?></option>

                                <?php } ?>
                            </select>
                            <input type="number" id="id_room" class="form-control"  name="id_room"   value="<?php echo $idRoom?>" readonly>
                            <!--I N P U T-->
                            <input type="number" id="seatsOcupped" class="form-control"  name="seatsOcupped"   value="0" readonly>
                            
                            <label for="date">Fecha de la funcion</label>
                            <!--I N P U T-->
                            <input type="text" id="date" class="form-control"  name="date"   value="<?php echo $date;?>" readonly>
                            
                            <select id="hora" name="hora" class="form-control">
                             <option value="" disabled selected> Seleccione unhorario</option>
                            <?php foreach($arrayHour as $value){ ?>
                            <option value="<?php echo $value;?>"> <?php echo $value;?></option>
                                <?php } ?>
                            </select>

                              
                        <!-- B O T O N -->
                            <button class="btn btn-lg btn-danger btn-block" type="submit">Agregar</button>
                </form>

                
            </div>
           
