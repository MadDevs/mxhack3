<?php

include ("includes/conn.php");

$mysqli = con_start();


$funcion = $_POST['funcion'];
$idprod = $_POST['idprod'];


function addFav($id){

	$smtp = $mysqli->prepare("UPDATE Product SET id_trans = 0 WHERE id_trans = 1");
    $smtp->execute();

    $smtp = $mysqli->prepare("UPDATE Product SET id_trans = 1 WHERE name like ?");
    $smtp->bind_param("s",$id);
    $smtp->execute();

    $smtp->close();
	echo "addFav" . $id;
}

function deleteProd($id){
	$smtp = $mysqli->prepare("UPDATE Product SET hidden = 1 WHERE name like ?");
    $smtp->bind_param("s",$id);
    $smtp->execute();
    $smtp->close();
	echo "deleteProd" . $id;
}


if($funcion == "addFav"){
	addFav($idprod);
}elseif ($funcion == "deleteProd") {
	deleteProd($idprod);
}

?>