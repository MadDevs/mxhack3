<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/3/15
 * Time: 10:13 PM
 */


$titulo = "Tandas";
include ("head.php");

include('./includes/conn.php');


$tipo = $_GET['tipo'];

var_dump(error_get_last());

$mysqli = con_start();

var_dump(error_get_last());
$ret = [];
$count = 0;

//$id = 1;

var_dump(error_get_last());
$smtp = $mysqli->prepare("SELECT id_tanda, name, intervalo_dias, num_personas, num_repeticiones, cantidad, is_active, fecha_inicial, turno FROM Tanda WHERE id_user = 1 and id_tanda ='$tipo'");


var_dump(error_get_last());
//$smtp->bind_param("i", $id);
$smtp->execute();

var_dump(error_get_last());
$smtp->store_result();
$smtp->bind_result($id_tanda, $name, $intervalo_dias, $num_personas, $num_repeticiones, $cantidad, $id_active, $fecha_inicial, $turno);


var_dump(error_get_last());

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

var_dump(error_get_last());

$smtp = $mysqli->prepare("SELECT nombre, turno FROM UsuariosTanda WHERE id_tanda = '$tipo'");

$smtp->execute();
$smtp->store_result();
$smtp->bind_result($nombre, $turno);


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


$difDias = floor($datediff/(60*60*24));
//$difDias = 90;
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
$data[] = array('nombre' => "Juan", 'turno' => $ret[0][8]);
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


    /*
     *
     *  <table class="table table-bordered">
        ...
        </table>

     */

    echo '<table class="table table-bordered">';
    echo    '<thead>';
    echo        '<tr>';
    echo        '<th>Periodos</th>';

    for($i = 0; $i< $ret[0][3]; $i++){

        echo        '<th>'.$nombre1[$i].'</th>';
    }
    echo        '</tr>';
    echo    '</thead>';
    echo    '<tbody>';


    for($i = 0; $i< $ret[0][3]; $i++){

        echo        '<tr>';
        echo       '<td>periodo'.($i + 1).'</td>';
        for($j = 0; $j< $ret[0][3]; $j++){
            if($turno1[$i]==($j))
                echo    '<td style="color: #468847; background-color: #DFF0D8;">'.$ret[0][5].'</td>';
            else
                '<td>'.$ret[0][5].'</td>';

        }
        echo        '</tr>';

    }

    echo    '</tbody>';

    echo    '</table>';

    ?>




</div>


<?php
include ("foot.php")
?>
