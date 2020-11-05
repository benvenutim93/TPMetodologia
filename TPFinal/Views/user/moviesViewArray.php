
<div class="cartelera-content">
    <div class="table-responsive-lg">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th  colspan=3 ><h1 class="text-center ">Cartelera</h1> </th>
                </tr>
            </thead>
            <tr>
                <?php foreach ($moviesList as $movie){
                 ?>
                <!-- Fotito facherita -->
                <td>    <div class="imagen-cartelera">
                    <img width= "100%" height="100%" src="<?php echo"https://image.tmdb.org/t/p/w200".$movie->getPoster_path()?>">
                </div>
                </td>
                <!-- contenido -->
                <td>
                    <h2 class="text-center"><u><?php echo $movie->getTitle();?></u></h2>
                    <h5>Sinopsis</h5>
                    <ul>
                            <!-- S I N O P S I S-->
                           
                            <li> <p ><?php echo $movie->getOverview();?></p> </li></ul> 
                            <!-- A D U L T-->
                            <h5>Adult</h5><ul>
                            <li> <p> <?php echo changeAdult($movie->getAdult());?></p>   </li></ul> 
                            <!-- L E N G U A J E -->
                            <h5>Lenguaje</h5><ul>
                            <li><p> <?php echo changeLanguage($movie->getOriginal_language());?></p> </li></ul> 
                            
                            <div class="row">
                                
                               
                                <div class="col">
                                 <div class="row">
                                    <!-- F E C H A-->
                                    <div class="col">
                                    <h5 class="text-center">Fecha de estreno:</h5>
                                   <p class="text-center"> <?php echo  $movie->getRelease_date();?></p> </div>
                                    <!-- V O  T O S -->
                                    <div class="col">
                                    <h5 class="text-center" >Votos:</h5>
                                    <P class="text-center"> <?php echo $movie->getVote_average();?></P>  </ul></div>
                                    <!-- P O P U L A R I D A D-->
                                    <div class="col">
                                    <h5 class="text-center">Popularidad:</h5>
                                    <p class="text-center"> <?php echo $movie->getPopularity();?></p>  </div>
                                     </div>
                                </div>
                    </div>
                </td>

                </tr>
                <?php } ?>
        </table>
    </div>
</div>

<?php


function changeLanguage ($language)
{
    switch ($language)
    {
        case "en": return "English";
            break;
        case "ja": return "Japones";
            break;
        case "ko": return "Coreano";
            break;
        case "it": return "Italiano";
            break;
        case "es": return "Español";
            break;
    }
}

function changeAdult ($adult)
{
    if ($adult)
    return "+18";
    else return "ATP";
}


?>