<div class="content-grande">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>Cinema/Modify" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="Views/img/logo.jpg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Cine</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!--I N P U T-->
            <input type="text" id="id" class="form-control" value="<?php echo $movie->getId()?>" name="id">
            <!-- L A B E L -->
            <label for="name" class="">Ingrese Nuevo Nombre </label>
            <!--I N P U T-->
            <input type="text" id="name" class="form-control" value="<?php echo $movie->getName()?>" name="name" required autofocus required minlength="3">
            <!-- L A B E L -->
            <label for="address" class="">Ingrese Nueva Direccion</label>
            <!--I N P U T-->
            <input type="text" id="address" class="form-control" value="<?php echo $movie->getAddress()?>"  name="address" required  minlength="5" required>
            <!-- L A B E L -->
            <label for="capacity" class="">Ingrese Nueva Capacidad</label>
            <!--I N P U T-->
            <input type="number"  id="capacity" class="form-control" value="<?php echo $movie->getCapacity()?>"  name="capacity" min="0" max="500" required>
            <!-- L A B E L -->
            <label for="ticketValue" class="">Ingrese Nuevo Valor de Entrada</label>
            <!--I N P U T-->
            <input type="number" id="ticketValue" class="form-control" value="<?php echo $movie->getTicketValue()?>"  name="ticketValue" min="0" max="500" required>

        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Modificar</button>

     </form>
     <div class="volver">
    <div class="row">
    <a class="btn btn-lg btn-light btn-block" href="<?php echo FRONT_ROOT ?>Cinema/showCinemaListAdmin" >Volver atras</a>
    </div>
</div>