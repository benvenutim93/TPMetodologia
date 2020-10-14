<?php
include_once("header.php");
include_once("nav.php");
?>

<div class="box uk-width-1-1">

        <h2 style="color:white">Cines</h2>

        <div class="tasks uk-flex uk-flex-wrap">
            

            <?php foreach($arrayC as $cine) { ?> 
                <div class="card uk-width-1-3@m">
                    <div class="uk-card uk-card-default">
                        <div class="uk-card-header">
                            <div class="uk-grid-small uk-flex-middle" uk-grid>
                                <div class="uk-width-auto">
                                    <span uk-icon="icon: comments"></span>
                                </div>
                                <div class="uk-width-expand">
                                    <h3 class="uk-card-title uk-margin-remove-bottom">
                                        <?php echo $cine->getName(); ?>
                                    </h3>
                                    <p class="uk-text-meta uk-margin-remove-top">
                                        <time datetime="2016-04-01T19:00">
                                        <?php echo $cine->getAddress(); ?>
                                        </time>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            <p><?php echo $cine->getCapacity(); ?></p>
                        </div>
                        <div class="uk-card-footer uk-flex uk-flex-between">
                            <div class="uk-flex uk-flex-middle">
                                <span uk-icon="icon: clock" class="uk-margin-small-right"></span><?php echo $cine->getTicketValue(); ?>
                            </div>
                            <div>
                                <form action="<?php FRONT_ROOT?>Remove" method="GET">
                                <!-- OJO este input es importante -->

                                    <input type="hidden" value="<?php echo $cine->getName(); ?>" name="title">
                                
                                    <!-- OJO este input es importante -->

                                
                                    <button type="submit" >Eliminar
                                        <!--<span uk-icon="icon: trash"></span>-->
                                    </button>
                                </form>
                            </div>
                            <div>
                                <form action="<?php FRONT_ROOT?>showCinemaModify" method="GET">
                                <!-- OJO este input es importante -->

                                    <input type="hidden" value="<?php echo $cine->getName(); ?>" name="title">
                                
                                    <!-- OJO este input es importante -->

                                
                                    <button type="submit" >Modificar
                                        <!--<span uk-icon="icon: trash"></span>-->
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>          
        
        </div>

    </div>

<?php
include_once("footer.php");
?>