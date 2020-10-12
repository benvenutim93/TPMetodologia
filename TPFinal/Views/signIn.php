<div class="user-register">
    <form class="form-signin" action= <?php FRONT_ROOT . "User/signIn" ?> method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="img/logo.jpg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Registrarse</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!-- L A B E L -->
            <div class="row">
                <div class="col">
                    <label for="nombreUser" >Nombre</label>
                    <!--I N P U T-->
                    <input type="text" id="nombreUser" class="form-control" placeholder="Nombre " name="name" required autofocus>
                </div>
                <div class="col">
                    <label for="apellidoUser" >Apellido</label>
                    <!--I N P U T-->
                    <input type="text" id="apellidoUser" class="form-control" placeholder="Apellido " name="lastName" required autofocus>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <label for="dniUser" >Dni</label>
                    <!--I N P U T-->
                    <input type="text" id="dniUser" class="form-control" placeholder="Dni " name="dni" required autofocus>
                </div>
                <div class="col">
                <label for="birthDateUser" >Fecha de nacimiento</label>
                    <!--I N P U T-->
                    <input type="date" id="birthDateUser" class="form-control" placeholder="Fecha de nacimiento " name="birth" required autofocus>

                </div>
            </div>
            
            <label for="inputPassword" >Ingrese contraseña</label>
            <!--I N P U T-->
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña"  name="password" required>
        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Registrarse</button>
             
     </form>
  
     
    <p class="mt-5 mb-3 ">&copy;<strong> Los supervivientes</strong> -2020</p>
    
</div>