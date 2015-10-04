<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 7:25 AM
 */


$name = $_GET['name'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$id_usuario = 1;

$time = date("Y-m-d");

$mysqli = con_start();

$smtp = $mysqli->prepare("INSERT INTO Deudores (id_user, name, description, amount)
      VALUES(?,?,?,?)");

$smtp->bind_param("issi",$id_usuario, $name, $description, $quantity);
$smtp->execute();
$smtp->free_result();
$smtp->close();

header('Location: deudas.php');


?>
