<div class="content-login">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>Cinema/Add" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Cine</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!-- L A B E L -->
            <label for="name" class="">Ingrese Nombre </label>
            <!--I N P U T-->
            <input type="text" id="name" class="form-control" placeholder="Nombre cine " name="name"   required minlength="3"required autofocus>
            <!-- L A B E L -->
            <label for="address" class="">Ingrese Direccion</label>
            <!--I N P U T-->
            <input type="text" id="address" class="form-control" placeholder="Direccion"  name="address" required minlength="3" required>
            <!-- L A B E L -->
            <label for="capacity" class="">Ingrese Capacidad</label>
            <!--I N P U T-->
            <input type="number" id="capacity" class="form-control" placeholder="Capacidad"  min="0" max="500" title ="Minimo 0 Maximo 500"name="capacity" required>
     
            <!--I N P U T
            <input type="number" id="ticketValue" class="form-control" placeholder="Valor Entrada" min="0" max="500"  name="ticketValue" required>-->

             <!-- L A B E L -->
             <label for="ticketValue" class="">Nombre de sala</label>
            <input type="text" id="room" class="form-control" placeholder="Nombre de sala" required minlength="3"  name="room" required>
             <!-- L A B E L -->
             <label for="ticketValue" class="">Cantidad de asientos</label>
            <input type="number" id="numberSeats" class="form-control" placeholder="Cantidad de asientos" min="0" max="300"   name="numberSeats" required>
             <!-- L A B E L -->
             <label for="ticketValue" class="">Valor Entrada</label>
            <input type="number" id="price" class="form-control" placeholder="Valor Entrada" min="0" max="500"  name="price" required>

        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
     </form>