<?php 
 $user =$_SESSION["logged"];
 
?>
<div class="alert alert-primary" role="alert">
   <?php echo "cantidad de entradas :".$cantidad ."<br>Id Funcion ".$idFuncion; ?>
</div>
<div class="content-chico">
    <div class="row">
        <div class="col">
            <h1 class="form-signin"><button class="btn btn-primary"  data-toggle="modal" data-target="#cargaTarjeta" type="button">Cargar Nueva  Tarjeta</button></h1>
        </div>
        <div class="col">

        </div>
    </div>
    
</div>
<div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            <h2>Listado de Tarjetas (Falta hacer Query para traer tarjeta y la funcion para comprar)</h2>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <!-- ACA VA EL FOREARCH --> 
          
            
            
                    <form action="<?php echo FRONT_ROOT?>"  class="list-group-item list-group-item-info ">
                        <div class="row">
                             <div class="col"> 
                                <!-- Cine -->
                                  <h4><font color ="black"> Tarjeta  </h4> 
                            </div>
                            <div class="col">
                                <!-- Sala -->
                                <h5></font> compania</h5>
                            </div>
                            <div class="col">
                                <!-- Fecha -->
                                <h3><font color ="red">Total</font></h3>
                            </div>
                            <div class="col">
                                <!-- Horario -->
                                <h5><font color ="red">Cantidad </font></h5> 
                           </div>
                            <div class="col">
                            
                                <button type="sumbit" class="btn btn-lg btn-danger btn-block" >Comprar</button>
                            </div>
                        </div>
                    </form>
                  
           
        </a>
        <form action="<?php echo FRONT_ROOT?>">
        <button type="sumbit"  class="btn btn-lg btn-primary btn-block" >Volver Atras</button>
        </form>
    </div>






<!-- CARGAR NUEVA TARJETA 
  
-->
<div class="modal fade" id="cargaTarjeta"  tabindex="-1" aria-labelledby="cierresesionLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel" >Cargar Tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content-grande">
                            <div class="card">
                            <h5 class="card-header">
                            <a class="list-group-item list-group-item-action active">
                                    <h5>Complete el Formulario</h5>
                                </a>
                            </h5>
                            <div class="card-body">
                                <form  method="post" action="<?php echo FRONT_ROOT?>User/addTarjeta">
                                            <h5 class="card-title">Titular de la tarjeta</h5>
                                            <input class="form-control" type="text" name="cardHolder"   minlength="6" required>
                                        <div class="row">
                                                <div class="col">
                                                <h5 class="card-title">Numero de la tajeta</h5>
                                                    <input class="form-control" type="text" name="numberCC"   minlength="16"pattern="[0-9]{16}" title="Deben ser [ NUMEROS ]. "required>
                                                </div>
                                                <div class="col">  
                                                    <h5 class="card-title">Fecha de expiracion</h5>
                                                    <input class="form-control" type="date" name="expiration" required>
                                                </div>
                                        </div>
                                        <h5 class="card-title">Compania</h5> 
                                        <input type="radio" name="company" value="1"  id="master" required>
                                        <label for="master">MasterdCard</label>
                                        <input type="radio" name="company" value="2" id="visa" required >
                                        <label for="visa">Visa</label>
                                    <p class="card-text">Los datos proporcionados no seran divulgados,son  encriptados .</p>
                                 
                                    <label for="idUser">idUser </label>
                                    <input class="form-control" type="number" id="idUser"  name="idUser" value="<?php echo  $user["id_user"]?>"  readonly>
                                    <label for="cant">Cantidad de entradas</label>
                                    <input class="form-control" type="number"  id="cant" name="cantidad" value="<?php echo $cantidad?>" readonly>
                                    <label for="idFuncion">id Funcion </label>
                                    <input class="form-control" type="number" id="idFuncion"  name="idFuncion" value="<?php echo $idFuncion?>"  readonly>
                                    <button  class="btn btn-lg btn-primary btn-block" type="submit"> Procesar Compra </button>
                                </form>
                            </div>
                </div> 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
           
