<div class="content-chico">
  
        <h1 class="text-center">Gestion de Cines</h1>
        <div class="row">

            <div class="col">
                <form action="<?php echo FRONT_ROOT?>Cinema/showCinemaForm" class="form-signin">
                 <button  class="btn btn-lg btn-success btn-block" type="submit">Alta cine</button>
                </form>
            </div>
          
            <div class="col">
                <form action="<?php echo FRONT_ROOT?>Cinema/showCinemaListAdmin" class="form-signin">
                    <button  class="btn btn-lg btn-success btn-block" type="submit">Listar Cines</button>
                </form>
            </div>
        </div>   

        <h1 class="text-center">Gestion de Usuarios</h1>
        <div class="row">  
            <div class="col">
                <form action="<?php echo FRONT_ROOT?>User/viewSetAdmin" class="form-signin">
                    <button  class="btn btn-lg btn-success btn-block" type="submit">Modificar Usuarios</button>
                </form>
            </div>
        </div>
        
        <h1 class="text-center">Gestion Contable</h1>
        <div class="row">
            <div class="col">
                <form action="<?php echo FRONT_ROOT?> HOLA ACA TOY " class="form-signin">
                    <button  class="btn btn-lg btn-danger btn-block" type="submit">Consultar Ventas</button>
                </form>
            </div>
            <div class="col">
                <form action="<?php echo FRONT_ROOT?>HOLA ACA SIGO" class="form-signin">
                    <button  class="btn btn-lg btn-danger btn-block" type="submit">Tickets Vendidos</button>
                </form>
            </div>
        </div>
</div>  
<br>
       
 
<div class="centerbutton">
    <form action= "<?php echo FRONT_ROOT?>Admin/showPrincipalView" class="form-signin">
        <button type="submit" class="btn btn-lg btn-primary btn-block">VOLVER</button>
    </form>
</div>

