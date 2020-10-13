<div class="content-login">
    <form class="form-signin" action= "<?php FRONT_ROOT?>registerCinema" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="Views/img/logo.jpg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Cine</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!-- L A B E L -->
            <label for="name" class="sr-only">Ingrese Nombre </label>
            <!--I N P U T-->
            <input type="text" id="name" class="form-control" placeholder="Nombre cine " name="name" required autofocus>
            <!-- L A B E L -->
            <label for="address" class="sr-only">Ingrese Direccion</label>
            <!--I N P U T-->
            <input type="text" id="address" class="form-control" placeholder="Direccion"  name="address" required>
            <!-- L A B E L -->
            <label for="capacity" class="sr-only">Ingrese Capacidad</label>
            <!--I N P U T-->
            <input type="text" id="capacity" class="form-control" placeholder="Capacidad"  name="capacity" required>
            <!-- L A B E L -->
            <label for="valticketValueue" class="sr-only">Ingrese Valor de Entrada</label>
            <!--I N P U T-->
            <input type="text" id="ticketValue" class="form-control" placeholder="Valor Entrada"  name="ticketValue" required>

        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
     </form>