<div class="content-grande">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>Cinema/Modify" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="Views/img/logo.jpg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Cine</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!-- L A B E L -->
            <label for="name" class="sr-only">Ingrese Nuevo Nombre </label>
            <!--I N P U T-->
            <input type="text" id="name" class="form-control" value="<?php echo $movie->getName()?>" name="name" required autofocus>
            <!-- L A B E L -->
            <label for="address" class="sr-only">Ingrese Nueva Direccion</label>
            <!--I N P U T-->
            <input type="text" id="address" class="form-control" value="<?php echo $movie->getAddress()?>"  name="address" required>
            <!-- L A B E L -->
            <label for="capacity" class="sr-only">Ingrese Nueva Capacidad</label>
            <!--I N P U T-->
            <input type="text" id="capacity" class="form-control" value="<?php echo $movie->getCapacity()?>"  name="capacity" required>
            <!-- L A B E L -->
            <label for="ticketValue" class="sr-only">Ingrese Nuevo Valor de Entrada</label>
            <!--I N P U T-->
            <input type="text" id="ticketValue" class="form-control" value="<?php echo $movie->getTicketValue()?>"  name="ticketValue" required>

        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Modificar</button>
     </form>