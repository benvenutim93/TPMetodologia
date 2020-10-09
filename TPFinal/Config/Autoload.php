<?php
    include_once("constants.php");
    spl_autoload_register (function ($className)
    {
        $fileName = ROOT . "\\" . $className.".php";
        #echo "Ruta de archivo: $fileName <br>";
        require_once ($fileName);
    });

?>