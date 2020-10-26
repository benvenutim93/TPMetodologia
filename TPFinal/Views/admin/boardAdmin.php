<div class="content-chico">
  
        <h1 class="text-center">Gestionar Cines</h1>
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
</div>      
<div class="content-grande">
        <div class="row">
            
            <div class="col">
                <form action="<?php echo FRONT_ROOT?>" class="form-signin">
                <h1 class="text-center">Entradas</h1>
                    <button  class="btn btn-lg btn-danger btn-block" type="submit">Consultar entradas VENDIDAS</button>
                </form>
            </div> 

            <div class="col">
                <form action="<?php echo FRONT_ROOT?>" class="form-signin">
                    <h1 class="text-center">Ventas</h1>
                        <button  class="btn btn-lg btn-danger btn-block" type="submit">Consultar Ventas</button>
                </form>
            </div>

            <div class="col">
                <form action="<?php echo FRONT_ROOT?>" class="form-signin">
                        <h1 class="text-center">Cartelera</h1>
                            <button  class="btn btn-lg btn-danger btn-block" type="submit">Ingresar Pelicula a  Cartelera</button>
                </form>
            </div>

        </div>
       
        <div class="row">
                <div class="col">
                        <form action= "<?php echo FRONT_ROOT?>Admin/showPrincipalView" class="form-signin">
                            <button type="submit" class="btn btn-lg btn-primary btn-block">VOLVER</button>
                        </form>
                    </div>
        </div>
        
</div>