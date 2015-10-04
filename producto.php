
<?php
    $titulo = "Nuevo objetivo";
    include ("head.php")
?>

<div class="container">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1>Nueva objetivo de compra</h1>
    <h2>&iexcl;Quieres una nuevo art&iacute;culo, es momento de ahorrar!</h2>
    <br>

    <form name="newProduct" class="form-horizontal" action="createProducto.php" method="POST">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nombre del art&iacute;culo</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name" placeholder="Ejemplo: Lavadora, motocicleta, television..">
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





