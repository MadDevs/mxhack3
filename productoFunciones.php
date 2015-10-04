<?php

include ("includes/conn.php");

$mysqli = con_start();


$funcion = $_POST['funcion'];
$idprod = $_POST['idprod'];


function addFav($id){
	echo "addFav" . $id;
}

function deleteProd($id){
	echo "deleteProd" . $id;
}


if($funcion == "addFav"){
	addFav($idprod);
}elseif ($funcion == "deleteProd") {
	deleteProd($idprod);
}

?>