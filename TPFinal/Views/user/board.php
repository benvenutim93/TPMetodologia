<?php 
$user = $_SESSION["logged"];
?>





<div class="content-grande">
    <div class="row">
        <div class="col">
              <h1>Bienvenido-  <strong ><font color ="red"  ><?php echo $user["firstName"]?>  </strong><?php echo $user["lastName"]?></font>  -</h1> 
        </div>
    </div>
    
    <div class="row">

            <div class="col">
                     <!-- F O R M -->
                    <form action="" class="form-singin">    
                            <button  class="btn btn-lg btn-danger btn-block" type="submit"> Comprar entradas </button>
                    </form>
                     <!-- F O R M -->
                    <form action="" class="form-singin">
                        <button  class="btn btn-lg btn-danger btn-block" type="submit"> Listar entradas </button>
                    </form>
                    <!-- F O R M -->
                    <form action=" <?php echo FRONT_ROOT?>User/showModifyView" class="form-singin">
                        <button  class="btn btn-lg btn-primary btn-block" type="submit"> Modificar Perfil </button>
                    </form>
                    <!-- F O R M -->
                    <form action=" <?php echo FRONT_ROOT?>Cinema/showCinemas_user" class="form-singin">
                        <button  class="btn btn-lg btn-primary btn-block" type="submit"> Listar Cines </button>
                    </form>

                    <?php if($user["id_userType"]==1){
                        echo'
                        <form action=" /Proyectos/TPFinal/Admin/showPrincipalView" class="form-singin">
                        <button  class="btn btn-lg btn-primary btn-block" type="submit"> Volver Atras </button>
                    </form>';
                    }
                    ?>

            </div>
            <div class="col" >
            <div class="col"><h5>Datos Del Usuario</h5></div>
                 <div class="row">  
                    <div class="col">
                        <!-- F O R M  MOSTRAR DATOS -->
                        <form action="" class="form-singin">
                            <label for="m"> Mail </label>
                            <input type="text"  id="m" class="form-control" value="<?php echo $user["mail"]?>"   readonly>
                            <label for="c"> Cumpleaños </label>
                            <input type="text"  id="c" class="form-control" value="<?php echo $user["birthDate"]?>"   readonly>
                        
                        </form>
                    </div>
                
            
                    <div class="col">
                        <!-- F O R M  MOSTRAR DATOS -->
                        <form action="" class="form-singin">

                            <label for="u"> Nombre de usuario </label>
                            <input type="text"  id="u" class="form-control" value="<?php echo $user["userName"]?>"   readonly>

                            <label for="d"> Dni </label>
                            <input type="text"  id="d" class="form-control" value="<?php echo $user["dni"]?>"   readonly>

                        </form>
                    </div>
                </div> 
            
            </div>
    </div>

</div>