<?php

include ("includes/conn.php");

$mysqli = con_start();


$funcion = $_POST['funcion'];
$idprod = $_POST['idprod'];


funcion addFav($id){
	return "addFav" . $id;
}

funcion deleteProd($id){
	return "deleteProd" . $id;
}


if($funcion == "addFav"){
	addFav($idprod);
}elseif ($funcion == "deleteProd") {
	deleteProd($idprod);
}

?>