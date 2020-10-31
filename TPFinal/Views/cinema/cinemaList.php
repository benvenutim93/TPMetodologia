

<div class="content-grande"><h1>Cines</h1><?php  foreach($cines as $value) {?>
            
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col">
                        <h3>Nombre cine</h3></div>
                        <div class="col">
                        <h3> <font color="white"><?php echo $value->getName();?></font></h3>
                        </div>
                    </div>
                     
                </div>
                <div class="col">
                    <h4> <font color="white"><?php echo $value->getAddress();?></font></h4>
                </div>
            </div>
                     <?php } ?>   
 
            <a href="<?php echo FRONT_ROOT?>User/showPrincipalView"  class="btn btn-lg btn-primary btn-block" >VOLVER</a>
    </div>       