
<div class="content-grande">
    <table class="table table-striped">
        <thead>
            <tr>
            <th scope="col">Id</th>
            <th scope="col">Porcentaje</th>
            <th scope="col">Cant. Minima</th>
            <th scope="col">Descripcion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($discountsList as $discount)
            {?>
                <tr>
                    <th scope="row"><?php echo $discount["id_discount"]?> </th>
                    <td><?php echo $discount["percentage"]?>%</td>
                    <td><?php echo $discount["minCant"]?></td>
                    <td><?php echo $discount["descript"]?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<form action="<?php echo FRONT_ROOT?>Room/index" method= "POST" class="form-signin">
    <div class="row">
        <input type="number" id="idCinema" class="sr-only"  name="idCinema"  value="<?php echo $idCinema?>" required autofocus>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Volver Atras</button>
    </div>     
</form>  