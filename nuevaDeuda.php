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

    <form class="form-horizontal" action="nuevaDeudaControlador.php>
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" placeholder="nombre">
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Descripcion</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="description" placeholder="descripcion">
            </div>
        </div>
        <div class="form-group">
            <label for="quantity" class="col-sm-2 control-label">Cantidad</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" id="quantity" placeholder="Cantidad">
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">Submitir</button>
            </div>
        </div>
    </form>




</div>


<?php
include ("foot.php")
?>

