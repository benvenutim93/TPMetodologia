
            <div class="content-chico">
                <form class="form-signin" action= "<?php echo FRONT_ROOT?>Function/Add" method="GET">
                            <!--Cambiar logo -->
                            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
                            <h1 class="h3 mb-3 font-weight-normal">Agregar Funcion</h1>
                      

                  
                            <label for="movi" >Ingrese Pelicula</label>
                            
                            <!--I N P U T-->
                            <select id="inputState" name="id_movie" class="form-control">
                             <option value="" disabled selected> Seleccione una pelicula </option>

                              <?php foreach($arrayAmostrar as $value){ ?>
                            <option value="<?php echo $value["id_movie"];?>"> <?php echo $value["title"];?></option>

                                <?php } ?>
                            </select>
                            <label>Id Sala</label>
                            <input type="number" id="id_room" class="form-control"  name="id_room"   value="<?php echo $idRoom?>" readonly>
                            <!--I N P U T-->
                            <input type="number" id="seatsOcupped" class="sr-only"  name="seatsOcupped"   value="0" readonly>
                            
                            <label for="date">Fecha de la funcion</label>
                            <!--I N P U T-->
                            <input type="text" id="date" class="form-control"  name="date"   value="<?php echo $date;?>" readonly>
                            
                            <label for="hour">Hora de la funcion</label>
                            <!--I N P U T-->
                            <input type="time" id="hour" class="form-control"  name="hour"  min="<?php echo $cine->getAperHour();?>" max="<?php echo $cine->getCloseHour()?>" value= ""required>

                              
                        <!-- B O T O N -->
                            <button class="btn btn-lg btn-success btn-block" type="submit">Agregar</button>
                </form>

                <div class="row">

                    <a href="<?php echo FRONT_ROOT?>Admin/showOPAdminsView" class="form-signin"><button class="btn btn-lg btn-primary btn-block" type="submit">Cancelar</button></a>

                </div>     

            </div>
           
