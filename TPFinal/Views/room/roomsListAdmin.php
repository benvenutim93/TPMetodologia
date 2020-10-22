
<!--
<div class="cartelera-content">
    <div class="table-responsive-lg">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th  colspan=3 ><h1 class="text-center ">Salas Del cine </h1> </th>
                </tr>
            </thead>
            <tr>
                <?php foreach ($arrayR as $room){?>
           
                    <td>    
                    <h1 ><?php echo $room->getName();?> </h1>
                    <p  > <strong>ID:<?php echo $room->getId();?></strong></p>
                        
                    </td>
               
                    <td>
                        <div class="row">
                            <div class="col">
                                <h5>Capacidad</h5>
                                <p> <strong><?php echo $room->getSeatsCapacity();?></strong></p>
                            </div>
                            <div class="col">
                                <h5>IdCINEMA</h5>
                                <p> <strong><?php echo $room->getIdCinema();?></strong></p>   
                            </div>
                        </div>
                        <div class="row">
                        <div class="col">
                                <h5>Precio</h5>
                                <p> <strong><?php echo $room->getTicketValue();?></strong></p> 
                            </div>
                        </div>
                    </td>
                </tr>
                <?php } ?>
        </table>
    </div>
</div>
-->


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
                        
                                <label for="idCine" >ID del Cine al que pertenece</label>
                                <!--I N P U T-->
                                <input type="text" id="idCine" class="form-control"   value="<?php echo $room->getIdCinema();?>" readonly>

   
                    </form>
                    <div class="row">
                            <div class="col">
                            <form class="form-signin" action="<?php echo FRONT_ROOT?>Room/Remove">
                            <input type="number"  class="sr-only"  name="id" value="<?php echo $room->getId();?>">
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
    <input type="number"  class="sr-only"  name="id" value="<?php echo $room->getIdCinema();?>">
        <a class="form-signin"><button class="btn btn-lg btn-primary btn-block" type="submit">Volver Atras</button></a>
    </form>
</div>