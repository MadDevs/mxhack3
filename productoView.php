<?php
/**
 * Created by PhpStorm.
 * User: Alfredo Hinojosa
 * Date: 10/4/2015
 * Time: 1:35 AM
 */
    include ("includes/conn.php");
    $title = "Productos deseados";
    include ("head.php");

    $mysqli = con_start();
    $ret = [];
    $count = 0;
    //$id = 1;
    $smtp = $mysqli->prepare("SELECT name, description, amount FROM Product WHERE id_user = 1");

    //$smtp->bind_param("i", $id);
    $smtp->execute();

    $smtp->store_result();
    $smtp->bind_result($name, $info, $cost);


    while ($smtp->fetch()) {
        $ret[$count][0] =  $name;
        $ret[$count][1] =  $info;
        $ret[$count][2] =  $cost;
        $count++;
    }

    $smtp->free_result();
    $smtp->close();

    //var_dump($ret);

?>
<div class="container">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1>Nueva objetivo de compra</h1>
    <h2>&iexcl;Quieres una nuevo art&iacute;culo, es momento de ahorrar!</h2>
    <br>
    <p class="bg-success" style="display: none; border-radius: 5px; text-align: center;" id="success">Producto agregado correctamente</p>
    <p class="bg-error" style="display: none;   border-radius: 5px; text-align: center;" id="error">Error al agregar producto</p>
    <form id="addProducto" name="newProduct" class="form-horizontal" action="createProducto.php" method="POST">
        <div class="form-group">
            <label for="nameProducto" class="col-sm-2 control-label">Nombre del art&iacute;culo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="nameProducto" id="nameProducto" placeholder="Ejemplo: Lavadora, motocicleta, television..">
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="col-sm-2 control-label">Descripci&oacute;n del art&iacute;culo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="description" id="description"
                       placeholder="Ejemplo: Es una televisi&oacute;n negra de 20 pulgadas marca LG">
            </div>
        </div>

        <div class="form-group">
            <label for="amount" class="col-sm-2 control-label">Costo $</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" step="50" name="amount" id="amount" placeholder="3,499">
            </div>
        </div>

        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>

        <button type="submit" class="btn btn-default">Guardar</button>

    </form>
</div><!-- /.container -->

<?php  include("foot.php") ?>
