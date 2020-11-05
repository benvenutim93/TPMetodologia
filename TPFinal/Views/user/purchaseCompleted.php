<div class="content-chico">
    <h1>Se realizo la compra con exito</h1>
    <?php foreach($qrarray as $qr)
                echo '<img src="data:image/png;base64,'.$qr.'">';?>
    <a href="<?php echo FRONT_ROOT?>User/showPrincipalView">Volver al inicio</a>
</div>