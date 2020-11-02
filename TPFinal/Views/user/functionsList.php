<div class="content-xxl">

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            <h2>Listado de Funciones [de una Pelicula]</h2>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <!-- ACA VA EL FOREARCH --> 
            <h4><?php echo $titulo;?></h4> 
            <?php foreach ($funciones as $movie){
            ?>
                    <form action="<?php echo FRONT_ROOT?>Ticket/purchase"  class="list-group-item list-group-item-info ">
                        <div class="row">
                             <div class="col"> 
                                <!-- Cine -->
                                  <h4><font color ="black"> <?php echo $movie["cinemaName"] ?></h4> 
                            </div>
                            <div class="col">
                                <!-- Sala -->
                                <h5><?php echo $movie["roomName"] ?></font></h5>
                            </div>
                            <div class="col">
                                <!-- Fecha -->
                                <h5><font color ="red"><?php echo $movie["functionDate"] ?></font></h5>
                            </div>
                            <div class="col">
                                <!-- Horario -->
                                <h5><font color ="red"><?php echo $movie["functionsHour"] ?></font></h5> 
                           </div>
                            <div class="col">
                                <!-- Input Cantidad entradas -->
                                <label for="">Entradas</label>
                                <input class="form-control" type="number" name="cantidad" placeholder="Ingrese cantidad de entradas a comprar." min="0" required>
                            </div>
                            <div class="col">
                            <input class="sr-only" type="number" name="idFuncion" value="<?php echo $movie["id_function"] ?>" readonly>
                            
                                <button type="sumbit" class="btn btn-lg btn-success btn-block" >Comprar</button>
                            </div>
                        </div>
                    </form>
                    <?php }?>
           
        </a>
        <form action="<?php echo FRONT_ROOT?>">
        <button type="sumbit"  class="btn btn-lg btn-primary btn-block" >Volver Atras</button>
        </form>
    </div>
    </div>