
<div class="content-login">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>User/login" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="<?php echo IMG_PATH;?>logo.jpeg" title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Iniciar Sesion</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!-- L A B E L -->
            <label for="inputEmail" class="sr-only">Ingrese Usuario</label>
            <!--I N P U T-->
            <input type="email" id="inputEmail" class="form-control" placeholder="Email " name="mail" required autofocus>
            <!-- L A B E L -->
            <label for="inputPassword" class="sr-only">Ingrese contraseña</label>
            <!--I N P U T-->
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"  name="password" required>
        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
     </form>
         <!--R E G I S T R A R S E -->
     <form class="form-signin" action= "<?php FRONT_ROOT?>User/showSingInFormView"  method="GET">
             <button class="btn btn-lg btn-info btn-block" type="submit"> Registrarse </button>
     </form>
         <!-- F A C E B O O K -->
     <form class="form-signin" action="" method="">
             <button class="btn btn-lg btn-info btn-block" type="submit"> Ingresar con Facebook</button>
     </form>
     <p>¿Tienes cuenta Admin? <a href="<?php FRONT_ROOT?>Admin/loginForm">Click aqui</a></p>
    <p class="mt-5 mb-3 ">&copy;<strong> Los supervivientes</strong> -2020</p>
    
</div>

