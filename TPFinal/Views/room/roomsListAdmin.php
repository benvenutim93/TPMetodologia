<?php foreach ($arrayR as $room){?> 
  
                 <div class="content-login">
                 <form class="form-signin">
                        <div class="row">
                            <div class="col">
                           
                                <label for="sala" >Nombre de la sala</label>
                                <!--I N P U T-->
                                <input type="text" id="sala" class="form-control"   value="<?php echo $room->getName();?>" readonly>
                            </div>
                            <div class="col">
                            <label for="idSala" >ID Sala</label>
                                <!--I N P U T-->
                                <input type="number" id="idSala" class="form-control"   value="<?php echo $room->getId();?>" readonly>

                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col">
                                    <label for="Capacidad" >Capacidad</label>
                                    <!--I N P U T-->
                                    <input type="number" id="Capacidad" class="form-control"   value="<?php echo $room->getSeatsCapacity();?>" readonly>
                            </div>
                            <div class="col">
                            <label for="precio" >Precio</label>
                                <!--I N P U T-->
                                <input type="text" id="precio" class="form-control"   value="<?php echo $room->getTicketValue();?>" readonly>

                            </div>
                        </div>
                        
                                <label for="idCine" >Nombre del Cine al que pertenece</label>
                                <!--I N P U T-->
                                <input type="text" id="idCine" class="form-control"   value="<?php echo $nombre;?>" readonly>

   
                    </form>
                    <div class="row">
                            <div class="col">
                            <form class="form-signin" action="<?php echo FRONT_ROOT?>Room/Remove">
                            <input type="number"  class="sr-only"  name="id" value="<?php echo $room->getId();?>">
                            <input type="number"  class="sr-only"  name="idCinema" value="<?php echo $room->getIdCinema();?>">
                            <button class="btn btn-lg btn-danger btn-block" type="submit"> Eliminar</button>
                        </form>
                            </div>
                            <div class="col">
                                <form class="form-signin" action="<?php echo FRONT_ROOT?>Room/showModifyRoom">
                                    <input type="number"  class="sr-only"  name="id" value="<?php echo $room->getId();?>">
                                    <button class="btn btn-lg btn-warning btn-block" type="submit"> Modificar</button>
                                </form>
                            </div>
                    </div>
                   
                  
                 </div>
        <?php } ?>             
       
    

<div class="row">
    <form action="<?php echo FRONT_ROOT?> Room/index" class="form-signin">
    <input type="number"  class="sr-only"  name="id" value="<?php echo $idCinema;?>">
        <a class="form-signin"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver Atras</button></a>
    </form>
</div>