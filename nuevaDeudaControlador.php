<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 7:25 AM
 */


include('./includes/conn.php');
$name = $_GET['name'];
$description = $_GET['description'];
$quantity = $_GET['quantity'];
$id_usuario = 1;



$mysqli = con_start();

echo "entre";

echo $name.$description.$quantity;

$smtp = $mysqli->prepare("INSERT INTO Deudores (id_user, name, description, amount)
      VALUES(?,?,?,?)");

echo"ejecute";

$smtp->bind_param("issi", $id_usuario, $name, $description, $quantity);

echo"ejecute1";
$smtp->execute();

echo"ejecute2";
$smtp->free_result();
$smtp->close();

//header("Location: deudas.php");
//die();


?>
