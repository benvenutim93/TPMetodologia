

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
                        <div class="row">
                            <div class="col">
                                    <ul>
                                    
                                    <li> <h3> Direccion </h3><p><strong><?php echo $cine->getAddress(); ?></p></strong> </li> 
                                    <li> <h3>Capacidad Maxima : </h3> <p ><strong><?php echo $cine->getCapacity(); ?></p></strong></li>
                                    <!-- Agregar cosas -->
                                    </ul>
                            </div>
                            <div class="col">
                                    <ul>
                                    <li><h3 > ID </h3><p ><strong><?php echo $cine->getId(); ?></p></strong></li>
                                    </ul>
                            </div>
                        </div>  
                        

                       <div class="row">
                           <div class="col">
                           <!-- Formulario -->
                              <form action="<?php FRONT_ROOT?>Remove" method="GET">
                                    <input type="hidden" value="<?php echo $cine->getId(); ?>" name="id">
                                    <button class="btn btn-lg btn-danger btn-block" type="submit">Eliminar</button>

                                </form>
                            </div>
                            <div class="col">
                            <!-- Formulario -->
                                <form action="<?php FRONT_ROOT?>showCinemaModify" method="GET">
                                    <input type="hidden" value="<?php echo $cine->getId(); ?>" name="id">
                                    <button class="btn btn-lg btn-warning btn-block" type="submit">Modificar</button>

                                </form>    
                          </div>
                        </div>

                        <div class="row">
                          <div class="col">
                          <!-- Formulario -->
                                <form action="<?php echo FRONT_ROOT?>Room/index" method="GET">
                                <input type="hidden" value="<?php echo $cine->getId(); ?>" name="idCinema">
                                    <button class="btn btn-lg btn-success btn-block" type="submit">Seleccionar</button>
                                </form>    
                          </div>
                      </div>
                              
                     </td>                
                </tr>   
                 <?php } ?>  
                 <tr>
                <td colspan=2 >
                <div class="row">
                        
                    <a class="btn btn-lg btn-light btn-block" href="<?php echo FRONT_ROOT ?>Admin/showOPAdminsView" >Volver atras</a>
                 </div>
    </div>  </td>
                       
                 </tr>  
             
        
           

        </table>
       
    
</div>



