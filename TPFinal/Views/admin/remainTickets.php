<?php $user = $_SESSION["logged"]["id_user"]?>
<?php if ($msgError){
require_once(VIEWS_PATH . "errorView.php");}?>


<div class="content-xxl">

    <div class="list-group">
        <a href="#" class="list-group-item list-group-item-action active">
            <h2>Entradas vendidas</h2>
        </a>
        <a href="#" class="list-group-item list-group-item-action">
            <!-- ACA VA EL FOREARCH --> 
            <?php foreach ($funciones as $movie){
            ?>
                    <form action="<?php echo FRONT_ROOT?>User/showListCards"  class="list-group-item list-group-item-info ">
                        <div class="row">
                             <div class="col"> 
                                <!-- Cine -->
                                  <h4><font color ="black"> <?php echo $movie["cinemaName"] ?></h4> 
                            </div>
                            <div class="col">
                                <!-- Sala -->
                                <h5><?php echo $movie["roomName"] ?></font></h5>
                            </div>
                            <div class="col">
                                <?php echo $movie["title"]?>
                            </div>
                            <div class="col">
                                <!-- Fecha -->
                                <h5><font color ="red"><?php echo $movie["functionDate"] ?></font></h5>
                            </div>
                            <div class="col">
                                <!-- Horario -->
                                <h5><font color ="red"><?php echo $movie["functionsHour"] ?></font></h5> 
                           </div>
                            <div class="col">
                                <!-- Input Cantidad entradas -->
                                <h5>Entradas vendidas: <font color="green"> <?php echo $movie["Cantidad"]?></font></h5>
                            </div>
                            <div class="col">
                                <!-- Input Cantidad entradas -->
                                <h5>Entradas remanentes: <font color="red"> <?php echo ($movie["seatsCapacity"] - $movie["Cantidad"])?></font></h5>
                            </div>
                        </div>
                    </form>
                    <?php }?>
           
        </a>
        <form action="<?php echo FRONT_ROOT?>Admin/showOPAdminsView">
            <button type="sumbit"  class="btn btn-lg btn-primary btn-block" >Volver Atras</button>
        </form>
    </div>
    </div>