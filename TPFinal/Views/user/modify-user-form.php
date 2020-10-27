<?PHP 
$user = $_SESSION["logged"];
?>
<div class="content-grande">
    <form class="form-signin" action= "<?php echo FRONT_ROOT?>User/modify" method="POST">
            <!--Cambiar logo -->
            <img class="mb-4" src="https://cdn.discordapp.com/attachments/699330820523163761/766036137641902160/logo72.jpeg"  title="Logo "alt="Logo del sistema" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Modificar Datos</h1>
            <!--Sacando el sr-only te muestra el titulo(LABEL)-->
            <!--I N P U T-->
          

            <label for="name" class="">Ingrese Nombre </label>
            <input type="text"  class="form-control" value="<?php echo $user["firstName"]?>" name="firstName" required minlength="5" autofocus required>
            
            <!--I N P U T-->
            <label for="address" class="">Ingrese Apellido</label>
            <input type="text"  class="form-control" value="<?php echo $user["lastName"]?>" name="lastName"  required minlength="5">
            <!--I N P U T-->
             <label for="address" class="">Ingrese Nombre Usuario</label>
            <input type="text"  class="form-control" value="<?php echo $user["userName"]?>"  name="userName" required  minlength="5" required>
            <!--I N P U T-->
            <label for="capacity" class="">Ingrese Mail</label>
            <input type="mail"   class="form-control" value="<?php echo $user["mail"]?>"  name="mail"   title="Debe tener almenos un @  " required>
           
            <div class="row">
                <div class="col">
                            <label for="capacity" class="">Ingrese dni</label>
                            <input type="number"   class="form-control" value="<?php echo $user["dni"]?>"  readonly>

                </div>
                <div class="col">
                        
                    <label for="capacity" class="">Ingrese Fecha de nacimiento</label>
                    <input type="date"   class="form-control" value="<?php echo $user["birthDate"]?>"  readonly>

                </div>
            </div>

        <!-- B O T O N -->
             <button class="btn btn-lg btn-primary btn-block" type="submit">Modificar</button>

        <input type="number"  class="sr-only" value="<?php echo $user["id_user"]?>" name="id_user" readonly>
        <a class="btn btn-lg btn-danger btn-block" href="<?php echo FRONT_ROOT ?>User/showPrincipalView" >Volver atras</a>
  

     </form>
     
</div>