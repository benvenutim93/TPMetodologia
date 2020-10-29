<?php 
    $array=["pepe","Juan","Carlos"];
?>

<div class="content-xxl">
    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            <h2>Listado de Usuarios</h2>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <?php foreach($users as $value) {?>
                                    <!-- Funcion -->
                    <form action="<?php echo FRONT_ROOT?>User/setAdmin"  class="list-group-item list-group-item-info ">
                        <div class="row">
                            <div class="col">
                             <!-- Nombre -->
                            <h4><?php echo $value["firstName"] ." ". $value["lastName"] ?></h4>
                             <!-- Mail -->
                            <h6><?php echo $value["mail"]; ?></h6>
                            <h6><?php echo "Rol: ";
                            switch ($value["id_userType"])
                            {
                                case 1: echo "Administrador";
                                    break;
                                case 2: echo "Usuario regular";
                                    break;
                                case 3: echo "Dueño de cine";
                                    break;
                            } ?></h6>
                            </div>
                            <div class="col">
                                <select id="id_userType" name="id_userType" class="form-control" required>
                                    <option value="" disabled selected> Seleccione uno </option>
                                    <option value="1"> Administrador</option>
                                    <option value="2"> Usuario</option>
                                    <option value="3"> Dueño de cine</option>

                                </select>
                                <input type="number" class="sr-only" id="id_user" name="id_user" value="<?php echo $value["id_user"]?>">
                            </div>
                            <div class="col">
                            <button type="sumbit" class="btn btn-lg btn-success btn-block" >Aplicar</button>
                            </div>
                        </div>
                        </form>
            <?php } ?>
        </a>
        <form action="<?php echo FRONT_ROOT?>/Admin/showOPAdminsView">
        <button type="sumbit"  class="btn btn-lg btn-info btn-block" >Volver Atras</button>
        </form>
    </div>
<div>