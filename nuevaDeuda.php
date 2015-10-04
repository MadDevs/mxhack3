<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 7:18 AM
 */

$titulo = "Deudas";
include ("head.php");

include('./includes/conn.php');


?>

<div class="container">

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>


    <h1>Nueva Deuda</h1>

    <div class="form-group">
        <form class="form-horizontal" action="nuevaDeudaControlador.php">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nombre</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="name" placeholder="nombre">
                </div>
            </div>
            <div class="form-group">
                <label for="description" class="col-sm-2 control-label">Descripcion</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="description" placeholder="descripcion">
                </div>
            </div>
            <div class="form-group">
                <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="quantity" placeholder="Cantidad">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">Submitir</button>
                </div>
            </div>
        </form>
    </div>




</div>


<?php
include ("foot.php")
?>

