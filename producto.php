
<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Nuevo objetivo</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

</head>


<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>




<div class="container">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <h1>Nueva objetivo de compra</h1>
    <h2>&iexcl;Quieres una nuevo art&iacute;culo, es momento de ahorrar!</h2>
    <br>

    <form id="addProducto" name="newProduct" class="form-horizontal" action="createProducto.php" method="POST">
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
    <p class="bg-success hidden" id="success">Producto agregado correctamente</p>
    <p class="bg-success hidden" id="error">Error al agregar producto</p>
</div><!-- /.container -->
 <script>


    $('#addProducto').on('submit', function (e) {

      e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'createTanda.php',
            data: $('#addTanda').serialize(),
            success: function (json) {
                    
                    if ($.trim(json)=="correct") {

                        setTimeout(function() {$("#success").show();}, 1000);
                        setTimeout(function() {$("#success").hide();}, 5000);
                    }
                    else {
                        setTimeout(function() {$("#error").show();}, 1000);
                        setTimeout(function() {$("#error").hide();}, 5000);   
                    }

                }
            });

    });
   </script>
</body>
</html>





