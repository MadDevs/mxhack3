<?php

    echo "<!DOCTYPE html>";
    echo "<html lang='en'>";
    echo "<head>";
    echo "<meta charset='utf-8'>";
    echo "<meta http-equiv='X-UA-Compatible' content='IE=edge'>";
    echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
    echo "<meta name='description' content=''>";
    echo "<meta name='author' content=''>";
    echo "<link rel='icon' href='../../favicon.ico'>";
    echo "<title>$titulo</title>";
    echo "<!-- Latest compiled and minified CSS -->";
    echo "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>";
    echo "<!-- jQuery -->";
    echo "<script src='https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>";
    echo "<!-- Latest compiled and minified JavaScript -->";
    echo "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>";
    echo "<!-- Custom styles for this template -->";
    echo "<link href='css/cover.css' rel='stylesheet'>";
    echo "</head>";

    /*ESTA PARTE ES DEL BODY*/
?>
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
            <a class="navbar-brand" href="home.php">Tu cochinito</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Inicio</a></li>
                <li><a href="ingress.php">Ingresos</a></li>
                <li><a href="egress.php">Egresos</a></li>
                <li><a href="#">Resumen</a></li>
                <li><a href="tandasView.php">Tanda</a></li>
                <li><a href="productoView.php">Productos deseados</a></li>
                <li><a href="#">Deudas</a></li>
                <li><a href="#">Ayuda</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
