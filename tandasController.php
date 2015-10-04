<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/3/15
 * Time: 9:49 PM
 */

$mysqli = con_start();
$ret = [];
$count = 0;

//$id = 1;
$smtp = $mysqli->prepare("SELECT id_tanda, name, intervalo_dias, num_personas, num_repeticiones, cantidad, id_active, fecha_inicial FROM Tanda WHERE id_user = 1");


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

$retTanda = [];
$countTanda = 0;


$smtp = $mysqli->prepare("SELECT nombre FROM UsuariosTanda WHERE id_tanda = $id_tanda");

for($i = 0; $i < $count; $i++){

}








var_dump($ret);




try {

    $DBH = new PDO("mysql:host=104.236.19.222;dbname=horoscopo", "nlcjohn", "01100101"); //5o4G3oPFec


} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
$result = $DBH->query("SELECT prediccion FROM predicciones WHERE signo='$signo'");
$row = $result->fetch(PDO::FETCH_ASSOC);
echo $signo." | ";
echo $row['prediccion'];


?>