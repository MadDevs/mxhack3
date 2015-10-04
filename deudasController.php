<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 5:42 AM
 */

include('./includes/conn.php');

$tipo = $_GET['tipo'];
$id_deudor = $_GET['id_deudor'];
$id_usuario = $_GET['id_usuario'];
$cantidad = $_GET['cantidad'];
$nombre = $_GET['nombre'];
$descripcion = $_GET['descripcion'];
$time = date("Y-m-d");
$type = 1;
$created = 0;

echo $tipo.$id_usuario.$id_deudor.$cantidad.$nombre.$descripcion.$time.$type.$time.$created;


if($tipo == "pagado"){

    $mysqli = con_start();
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created, description)
      VALUES(?,?,?,?,?,?)");
    $smtp->bind_param("iiiiss",$id_usuario,$type, $cantidad,$created, $created, $nombre." pago su deuda");
    $smtp->execute();
    $smtp->free_result();
    $smtp->close();

    $mysqli = con_start();
    $smtp = $mysqli->prepare("UPDATE Deudores SET hidden = 1 WHERE id_deudor = '.$id_deudor.'");
    $smtp->execute();
    $smtp->free_result();
    $smtp->close();


}
else{

    $mysqli = con_start();
    $smtp = $mysqli->prepare("UPDATE Deudores SET hidden = 1 WHERE id_deudor = '.$id_deudor.'");
    $smtp->execute();
    $smtp->free_result();
    $smtp->close();

}

//header("Location: deudas.php");
//die();


?>
