<?php if ($msgError){
require_once(VIEWS_PATH . "errorView.php");}?>

<div class="row">
<form action="<?php echo FRONT_ROOT?>User/login" method="post">
<input type="email" id="inputEmail" class="sr-only" name="email"  value="rope@rope" required autofocus>
<input type="pass" id="inputEmail" class="sr-only"  name="pass" value="hola123"required autofocus>

<button class="btn btn-lg btn-info btn-block" type="submit"> Admin de una pa</button>
</form>
</div>







<div class="content-login">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>User/login" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg" title="Logo "alt="Logo del sistema" width="72" height="72">
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
     <form class="form-signin" action= "<?php echo FRONT_ROOT?>User/showSingInFormView"  method="GET">
             <button class="btn btn-lg btn-info btn-block" type="submit"> Registrarse </button>
     </form>
         <!-- F A C E B O O K -->
        <!--<form class="form-signin" action="" method="">
             <button class="btn btn-lg btn-danger btn-block" type="submit"> Ingresar con Facebook</button>-->
             <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v8.0&appId=426152348779421&autoLogAppEvents=1" nonce="znZ2gQYx"></script>
     </form>
     <div class="fb-login-button" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" data-width=""></div>
    <p class="mt-5 mb-3 ">&copy;<strong> Los supervivientes</strong> -2020</p>
    
</div>

