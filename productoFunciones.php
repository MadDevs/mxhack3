<?php

include ("includes/conn.php");

$mysqli = con_start();


$funcion = $_POST['funcion'];
$idprod = $_POST['idprod'];


funcion addFav($id){
	return "addFav" . $id;
}

funcion addFav($id){
	return "delete" . $id;
}


if($funcion == "addFav"){
	addFav($idprod);
}elseif ($funcion == "delete") {
	delete($idprod);
}

?>