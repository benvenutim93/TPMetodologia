<?php
include_once("header.php");
include_once("nav.php");

?>

<div class="cartelera-content">
    <div class="table-responsive-lg">
        <table class="table table-hover" >
            <thead>
                <tr>
                    <th  colspan=3 ><h2 class="text-center ">Cartelera</h2> </th>
                </tr>
            </thead>
            <tr>
                <?php foreach ($moviesList as $movie){?>
                <!-- Fotito facherita -->
                <td><div class="imagen-cartelera">
                <h1 class="text-center"> Imagen facherita</h1>
                </div>
                </td>
                <!-- contenido -->
                <td>
                    <h1 class="text-center"><?php echo $movie->getTitle();?></h1>
                    <h2>Sinopsis</h2>
                    <ul>
                            <!-- S I N O P S I S-->
                            <li> <p ><?php echo $movie->getOverview();?></p> </li>
                            <!-- A D U L T-->
                            <li> <p>Adult: <?php echo changeAdult($movie->getAdult());?></p>   </li>
                            <!-- L E N G U A J E -->
                            <li><p>Lenguaje: <?php echo changeLanguage($movie->getOriginal_language());?></p> </li>
                            <li><p>Genero:</p>
                            <!-- G E N E R O--> 
                                <ul class="list-group list-group-horizontal ">
                                    <?php
                                    $arrayGenres = $movie->getGenre_ids();
                                    foreach($arrayGenres as $genre)
                                    {?>
                                    <li class="none "> <?php echo $genreRepo->GetOne($genre);?></li>
                                    <li class="none "> <strong>-</strong> </li>
                                    <?php }?>
                                </ul> 
                            </li>
                        <!-- F E C H A-->
                        <li><p>Fecha de estreno: <?php echo  $movie->getRelease_date();?></p> </li>
                        <!-- V O  T O S -->
                        <li><P>Votos: <?php echo $movie->getVote_average();?></P> </li>
                        <!-- P O P U L A R I D A D-->
                        <li> <p>Popularidad: <?php echo $movie->getPopularity();?></p> </li>
                    </ul> 
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

include_once("footer.php");
?>