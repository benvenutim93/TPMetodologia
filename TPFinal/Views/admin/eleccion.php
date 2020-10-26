<div class="content-grande">

<div class="form-signin">
    <form action="<?php echo FRONT_ROOT?>Admin/showOPAdminsView" >
        <button class="btn btn-lg btn-dark btn-block" type="submit">
        Realizar Operaciones Admins</button>
    </form>
    <form action="<?php echo FRONT_ROOT?>Admin/showOPUsersView">
    <button  class="btn btn-lg btn-dark btn-block" type="submit">
                <font color="red"> Realizar Operaciones de Usuarios</font></button>
    </form>
        
     <form action= "<?php echo FRONT_ROOT?>Admin/loginForm">
         <button type="submit" class="btn btn-lg btn-primary btn-block">VOLVER</button>
    </form>
        
</div>

<?php
?>