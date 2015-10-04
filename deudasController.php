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
$hidden = 1;
$nombremejor =  $nombre." pago su deuda";
//echo $tipo.$id_usuario.$id_deudor.$cantidad.$nombre.$descripcion.$time.$type.$time.$created;


if($tipo == "pagado"){

   // echo "entro a pagar";
    $mysqli = con_start();
    //echo "entro a pagar";
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created, description) VALUES(?,?,?,?,?,?)");
    //echo "entro a pagar";
    $smtp->bind_param("iiiiss",$id_usuario,$type, $cantidad,$created, $created,$nombremejor);
    //echo "entro a pagar";
    $smtp->execute();
    //echo "entro a pagar";
    $smtp->free_result();
   // echo "entro a pagar";
    $smtp->close();

    $mysqli = con_start();

    $smtp = $mysqli->prepare("UPDATE Deudores SET hidden = 1 WHERE id_deudor = '.$id_deudor.'");
    $smtp->execute();

    $smtp->free_result();
    $smtp->commit();
    $smtp->close();


}
else{


    //echo $id_deudor;


    $mysqli = con_start();

    $smtp = $mysqli->prepare("UPDATE Deudores SET hidden = 1 WHERE id_deudor = '.$id_deudor.'");

    $smtp->execute();

    //

    $smtp->free_result();
    $smtp->commit();

    $smtp->close();

    /*UPDATE `mxhacks`.`Deudores` SET `hidden`='1' WHERE `id_deudor`='1';*/

}

//header("Location: deudas.php");
//die();


?>
