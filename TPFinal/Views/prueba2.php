<div class="content-xxl">
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            <h2>Listado de Funciones [de una Pelicula]</h2>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <!-- Funcion -->
            <h4>Funcion (nombre de la Pelicula )</h4> 
                    <form action="<?php echo FRONT_ROOT?>"  class="list-group-item list-group-item-info ">
                        <div class="row">
                             <div class="col"> 
                                <!-- Cine -->
                                  <h4><font color ="black">Cine(nombre)</h4> 
                            </div>
                            <div class="col">
                                <!-- Sala -->
                                <h5>Sala(nombre)</font></h5>
                            </div>
                            <div class="col">
                                <!-- Fecha -->
                                <h5><font color ="red">Fecha</font></h5>
                            </div>
                            <div class="col">
                                <!-- Horario -->
                                <h5><font color ="red">Horario</font></h5> 
                           </div>
                            <div class="col">
                                <!-- Input Cantidad entradas -->
                                <label for="">Entradas</label>
                                <input class="form-control" type="number" name="cantidad" placeholder="Ingrese cantidad de entradas a comprar." min="0" required>
                            </div>
                            <div class="col">
                                <button type="sumbit" class="btn btn-lg btn-success btn-block" >Comprar</button>
                            </div>
                        </div>
                    </form>
           
        </a>
        <form action="<?php echo FRONT_ROOT?>">
        <button type="sumbit"  class="btn btn-lg btn-primary btn-block" >Volver Atras</button>
        </form>
    </div>
    </div>


<div class="content-grande">
    <div class="card">
        <h5 class="card-header">
        <a class="list-group-item list-group-item-action active">
                <h5>Descuentos</h5>
         </a>
        </h5>
        <div class="card-body">
            <form  method="get" action="">
                    <h5 class="card-title">Descripcion</h5>
                     <!-- descripcion -->
                    <input class="form-control" type="text" name="description"   minlength="6" required>
                <div class="row">
                        <div class="col">
                        <h5 class="card-title">Descuento</h5>
                         <!-- Descuento -->
                            <input class="form-control" type="number" name="discount"   min="0" max="100"required>
                        </div>
                        <div class="col">  
                            <h5 class="card-title">Cantidad minima</h5>
                             <!-- CantMinima -->
                            <input class="form-control" type="number" name="cantMinima" min="0" required>
                        </div>
                </div>
                <label for=""> </label>
                <button  class="btn btn-lg btn-primary btn-block" type="submit"> Confirmar </button>
            </form>
        </div>
    </div>
</div>

























<div class="content-grande">
    <div class="card">
    <h5 class="card-header">
    <a class="list-group-item list-group-item-action active">
            <h5>Complete el Formulario</h5>
        </a>
    </h5>
    <div class="card-body">
        <form  method="get" action="">
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
            <input type="radio" name="company" id="master" required>
            <label for="master">MasterdCard</label>
            <input type="radio" name="company" id="visa" required >
            <label for="visa">Visa</label>
        <p class="card-text">Los datos proporcionados no seran divulgados,son  encriptados .</p>
        <button  class="btn btn-lg btn-primary btn-block" type="submit"> Confirmar </button>
        </form>
    </div>
    </div>
</div>