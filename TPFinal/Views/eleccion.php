<?php
require_once("header.php");
require_once("nav.php");
?>
<div class="content-grande">


<button class="btn btn-lg btn-dark btn-block" type="submit">
 <a href="<?php echo FRONT_ROOT?>Admin/showOPAdminsView" style="black">Realizar Operaciones Admins</a></button>


<button class="btn btn-lg btn-dark btn-block" type="submit">
 <a href="<?php echo FRONT_ROOT?>Admin/showOPUsersView" style="black">Realizar Operaciones de Usuarios</a></button>


<?php
require_once("footer.php");
?>