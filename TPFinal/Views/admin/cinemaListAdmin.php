

<div class="cartelera-content">
    <div class="table-responsive-lg">
        <table class="table table-hover" >
        <thead>
                <tr>
                    <th  colspan=2 ><h1 class="text-center ">Cines</h1> </th>
                </tr>
         </thead>
            <?php foreach($arrayC as $cine) { ?> 
                <tr>
                    <td>
                        <h2 class="text-center">  <?php echo $cine->getName(); ?></h2>
                    </td>
                    <td>      
                        <ul>
                              <li><h3> ID </h3><p><strong><?php echo $cine->getId(); ?></p></strong> </li> 
                              <li><h3> Direccion </h3><p><strong><?php echo $cine->getAddress(); ?></p></strong> </li> 
                              <li> <h3>Capacidad Maxima : </h3> <p ><strong><?php echo $cine->getCapacity(); ?></p></strong></li>
                              <li><h3>Valor de entrada :</h3> <p><strong><?php echo $cine->getTicketValue(); ?> </strong></p></li>         
                                       
                              
                       </ul>   
                       <div class="row">
                           <div class="col">
                              <form action="<?php FRONT_ROOT?>Remove" method="GET">
                                    <input type="hidden" value="<?php echo $cine->getName(); ?>" name="title">
                                    <button class="btn btn-lg btn-danger btn-block" type="submit">Eliminar</button>

                                </form>
                            </div>
                            <div class="col">
                                <form action="<?php FRONT_ROOT?>showCinemaModify" method="GET">
                                    <input type="hidden" value="<?php echo $cine->getId(); ?>" name="title">
                                    <button class="btn btn-lg btn-warning btn-block" type="submit">Modificar</button>

                                </form>    
                          </div>
                            
                      </div>
                              
                     </td>                
                </tr>   
            <?php } ?>    
        </div>      
    </div>  
    <div class="volver">
    <div class="row">
    <a class="btn btn-lg btn-light btn-block" href="<?php echo FRONT_ROOT ?>Admin/showOPAdminsView" >Volver atras</a>
    </div>
</div>
</div>

  

