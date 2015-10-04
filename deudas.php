<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 4:59 AM
 */

$titulo = "Deudas";
include ("head.php");

include('./includes/conn.php');


$mysqli = con_start();

var_dump(error_get_last());

$smtp = $mysqli->prepare("SELECT id_deudor, id_user, name, description, amount, completed, hidden FROM Deudores WHERE id_user = 1");

var_dump(error_get_last());
$smtp->execute();
var_dump(error_get_last());

$smtp->store_result();
var_dump(error_get_last());
$smtp->bind_result($id_deudor, $id_user, $name, $description, $amount, $completed, $hidden);

while ($smtp->fetch()) {
    $ret[$count][0] =  $id_deudor;
    $ret[$count][1] =  $id_user;
    $ret[$count][2] =  $name;
    $ret[$count][3] =  $description;
    $ret[$count][4] =  $amount;
    $ret[$count][5] =  $completed;
    $ret[$count][6] =  $hidden;

    $count++;
}
//echo "test 3";

$smtp->free_result();
$smtp->close();



?>

<div class="container">

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>


    <h1>Deudas</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Cantidad</th>
            <th>Estatus</th>
        </tr>
        </thead>
        <tbody>
        <tr>
         <?php

         foreach($ret as $personas){
             echo '<td>'.$personas[2].'</td>';
             echo '<td>'.$personas[3].'</td>';
             echo '<td>'.$personas[4].'</td>';
             echo '<td> <form> <label class="checkbox-inline"><input type="checkbox" id="inlineCheckbox1" value="option1"> Pagado </label> <label class="checkbox-inline"> <input type="checkbox" id="inlineCheckbox2" value="option2"> X </label><button type="submit" class="btn btn-default">Submit</button> </form> </td>';
         }

         ?>
         </tr>

        </tbody>
    </table>


</div>










<?php
include ("foot.php")
?>

