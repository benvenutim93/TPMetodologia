<?php
include_once("header.php");
include_once("nav.php");
?>

<div class="content-login">
    <!-- div para poner el fondo -->
    <div class="admin-login">
        <form class="form-signin" action="<?php echo FRONT_ROOT?>Admin/login" method="POST">
                <!--Cambiar logo -->
                <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
                <!--Sacando el sr-only te muestra el titulo(LABEL)-->
                <!-- L A B E L -->
                <label for="inputEmail" class="sr-only">Ingrese Mail</label>
                <!--I N P U T-->
                <input type="email" id="inputEmail" class="form-control" placeholder="Email " name="mail" required autofocus>
                <!-- L A B E L -->
                <label for="inputPassword" class="sr-only">Ingrese contraseña</label>
                <!--I N P U T-->
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"  name="password" required>
            <!-- B O T O N -->
                <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>

        </form>



            <!-- F A C E B O O K
        <form class="form-signin" action="" method="">
                <button class="btn btn-lg btn-info btn-block" type="submit"> Ingresar con el  Feibuk</button>
        </form>  -->

    <p class="mt-5 mb-3 " style="color:white">&copy;<strong > Los supervivientes</strong> -2020</p>
    </div>
</div>

<?php
include_once("footer.php");
?>