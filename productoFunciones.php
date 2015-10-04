<?php

include ("includes/conn.php");

$mysqli = con_start();


$funcion = $_POST['funcion'];
$id = $_POST['idprod'];

if($funcion == "addFav"){
	$smtp = $mysqli->prepare("UPDATE Product SET id_trans = 0 WHERE id_trans = 1");
    $smtp->execute();

    $smtp = $mysqli->prepare("UPDATE Product SET id_trans = 1 WHERE name like ?");
    $smtp->bind_param("s",$id);
    $smtp->execute();

    $smtp->close();
	echo $id;
}elseif ($funcion == "deleteProd") {
	$smtp = $mysqli->prepare("UPDATE Product SET hidden = 1 WHERE name like ?");
    $smtp->bind_param("s",$id);
    $smtp->execute();
    $smtp->close();
	echo $id;
}

?>