<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/3/15
 * Time: 10:13 PM
 */


include('./includes/conn.php');
$tipo = $_GET['tipo'];


$mysqli = con_start();
$ret = [];
$count = 0;

//$id = 1;
$smtp = $mysqli->prepare("SELECT id_tanda, name, intervalo_dias, num_personas, num_repeticiones, cantidad, id_active, fecha_inicial FROM Tanda WHERE id_user = 1 and id_tanda ='$tipo'");


//$smtp->bind_param("i", $id);
$smtp->execute();
$smtp->store_result();
$smtp->bind_result($id_tanda, $name, $intervalo_dias, $num_personas, $num_repeticiones, $cantidad, $id_active, $fecha_inicial);


while ($smtp->fetch()) {
    $ret[$count][0] =  $id_tanda;
    $ret[$count][1] =  $name;
    $ret[$count][2] =  $intervalo_dias;
    $ret[$count][3] =  $num_personas;
    $ret[$count][4] =  $num_repeticiones;
    $ret[$count][5] =  $cantidad;
    $ret[$count][6] =  $id_active;
    $ret[$count][7] =  $fecha_inicial;

    $count++;
}
//echo "test 3";

$smtp->free_result();
$smtp->close();

$mysqli = con_start();
$ret2 = [];
$count = 0;

$smtp = $mysqli->prepare("SELECT nombre FROM UsuariosTanda WHERE id_tanda = '$tipo'");

$smtp->execute();
$smtp->store_result();
$smtp->bind_result($nombre);


while ($smtp->fetch()) {
    $ret2[$count][0] =  $nombre;

    $count++;
}

$smtp->free_result();
$smtp->close();

//tiempo
$now = time(); // or your date as well
$your_date = strtotime($ret[0][7]);
$datediff = $now - $your_date;


//$difDias = floor($datediff/(60*60*24));
$difDias = 90;
$continua = false;
//                               numperso    intervalo dias

$cicloActual = floor($difDias / ($ret[0][3] * $ret[0][2]));
$diasEnCicloActual = $difDias % ($ret[0][3] * $ret[0][2])  ;
                   //numrepeticiones

if($cicloActual < $ret[0][4]){
    $continua = true;

}

$usrActual = floor( $diasEnCicloActual / $ret[0][2]);




//$datediff = strtotime("2015-10-08") - strtotime("2015-10-04");


/*
foreach($ret as $tandas){
    echo '<form action="tandasController.php">';
    echo '<button name="tipo" value="'.$tandas[0].'" type="submit" class="btn btn-primary btn-lg btn-block">'.$tandas[1].'</button>';
    echo '</form>';
}

*/




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

    <title>Tandas</title>

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
    <p>&nbsp;</p>

    <h1>Es turno de </h1>
    <?php



        echo '<h2>'.$ret2[$usrActual][0].'</h2>';

        if($continua) {
            echo '<h2>Ciclo # ' . ($cicloActual + 1) . ' de  # ' . $ret[0][4] . '</h2>';
        }
        else{
            echo '<h2>FIN DEL CICLO</h2>';
            echo '<h2>Ciclo # ' . $ret[0][4]. ' de  # ' . $ret[0][4] . '</h2>';
        }

    ?>


</div>



</body>


</html>