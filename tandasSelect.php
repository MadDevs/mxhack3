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
$smtp = $mysqli->prepare("SELECT id_tanda, name, intervalo_dias, num_personas, num_repeticiones, cantidad, id_active, fecha_inicial, turno FROM Tanda WHERE id_user = 1 and id_tanda ='$tipo'");


//$smtp->bind_param("i", $id);
$smtp->execute();
$smtp->store_result();
$smtp->bind_result($id_tanda, $name, $intervalo_dias, $num_personas, $num_repeticiones, $cantidad, $id_active, $fecha_inicial, $turno);


while ($smtp->fetch()) {
    $ret[$count][0] =  $id_tanda;
    $ret[$count][1] =  $name;
    $ret[$count][2] =  $intervalo_dias;
    $ret[$count][3] =  $num_personas;
    $ret[$count][4] =  $num_repeticiones;
    $ret[$count][5] =  $cantidad;
    $ret[$count][6] =  $id_active;
    $ret[$count][7] =  $fecha_inicial;
    $ret[$count][8] =  $turno;

    $count++;
}
//echo "test 3";

$smtp->free_result();
$smtp->close();

$mysqli = con_start();
$ret2 = [];
$count = 0;

$smtp = $mysqli->prepare("SELECT nombre, turno FROM UsuariosTanda WHERE id_tanda = '$tipo'");

$smtp->execute();
$smtp->store_result();
$smtp->bind_result($nombre);


while ($smtp->fetch()) {
    $ret2[$count][0] =  $nombre;
    $ret2[$count][1] =  $turno;

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





///$data[] = array('volume' => 67, 'edition' => 2);
/*
$data[] = array('volume' => 86, 'edition' => 1);
$data[] = array('volume' => 85, 'edition' => 6);
$data[] = array('volume' => 98, 'edition' => 2);
$data[] = array('volume' => 86, 'edition' => 6);
$data[] = array('volume' => 67, 'edition' => 7);
*/
$data[] = array('nombre' => $ret[0][1], 'turno' => $ret[0][8]);
foreach($ret2 as $adusr) {
    $data[] = array('nombre' => $adusr[0], 'turno' => $adusr[1]);
}

// Obtain a list of columns
foreach ($data as $key => $row) {
    $nombre1[$key]  = $row['nombre'];
    $turno1[$key] = $row['turno'];
}

// Sort the data with volume descending, edition ascending
// Add $data as the last parameter, to sort by the common key
array_multisort($turno1, SORT_ASC, $nombre1, SORT_ASC, $data);

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


        /*
         * //original sin cambios de nuevas variables
        echo '<h2>'.$ret2[$usrActual][0].'</h2>';

        if($continua) {
            echo '<h2>Ciclo # ' . ($cicloActual + 1) . ' de  # ' . $ret[0][4] . '</h2>';
        }
        else{
            echo '<h2>FIN DEL CICLO</h2>';
            echo '<h2>Ciclo # ' . $ret[0][4]. ' de  # ' . $ret[0][4] . '</h2>';
        }
        */

        echo '<h2>'.$nombre1[$usrActual].'</h2>';

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