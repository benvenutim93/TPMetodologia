<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="Views/css/estilo.css">
    <title>Prueba</title>
</head>
<body>
<div class="content-login">
    <form class="form-signin" action="" method="">
            <!--Cambiar logo -->
            <img class="mb-4" src="Views/img/logo.jpg"  title="Logo "alt="Logo del sistema" width="72" height="72">
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
     <form class="form-signin" action="" method="">
             <button class="btn btn-lg btn-info btn-block" type="submit"> Registrarse </button>
     </form>
         <!-- F A C E B O O K -->
     <form class="form-signin" action="" method="">
             <button class="btn btn-lg btn-info btn-block" type="submit"> Ingresar con Facebook</button>
     </form>
    <p class="mt-5 mb-3 ">&copy;<strong> Los supervivientes</strong> -2020</p>
    
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>