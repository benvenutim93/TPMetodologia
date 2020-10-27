<?php
require "Config/Config.php";
$pass = "holaManola";

$passCrypt = hash("sha256", $pass, true);

$contraCrypt = hash("sha256", "holaManola", true);
echo $passCrypt;
echo "<br> $contraCrypt";
if ($passCrypt == $contraCrypt)
    echo "entro";

?>