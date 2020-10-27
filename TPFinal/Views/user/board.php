<?php
print_r($_SESSION["logged"]) ;

/*Botones de:
Comprar entradas
Listar entradas adquiridas
Modificar perfil 
Listar cines */
?>

<div class="content-chico">
  
        <h1 class="text-center">Gestionar Cines</h1>
        <div class="row">
            <div class="col">
                <a class="btn btn-lg btn-success btn-block" href="<?php echo FRONT_ROOT?>Cinema/showCinemaForm">Alta cine</a>
            </div>
          
            <div class="col">
                <a class="btn btn-lg btn-success btn-block" href="<?php echo FRONT_ROOT?>Cinema/showCinemaListAdmin">Listar Cines </a>
            </div>
        </div>
</div>      
<div class="content-grande">
        <div class="row">
            
            <div class="col">
                    <h1 class="text-center">Perfil</h1>
                    <a class="btn btn-lg btn-danger btn-block" href="<?php echo FRONT_ROOT?>User/viewProfile">Ver Perfil </a>
            </div> 
            <div class="col">
                     <h1 class="text-center">Ventas</h1>
                     <a class="btn btn-lg btn-danger btn-block" href="<?php echo FRONT_ROOT?>">Consultar Ventas </a>
            </div>
            <div class="col">
                     <h1 class="text-center">Cartelera</h1>
                     <a class="btn btn-lg btn-danger btn-block" href="<?php echo FRONT_ROOT?>">Ingresar Pelicula a  Cartelera </a>
            </div>
        </div>
       
        <div class="row">
        <div class="col">
            <form action= "<?php echo FRONT_ROOT?>Admin/showPrincipalView">
            <button type="submit" class="btn btn-lg btn-primary btn-block">VOLVER</button>
            </form>
            </div>
        </div>
        
</div>