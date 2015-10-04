<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/4/15
 * Time: 10:12 AM
 */


$titulo = "Tandas";
include ("head.php");

include('./includes/conn.php');


$mysqli = con_start();

$smtp = $mysqli->prepare("SELECT id_user, type, amount, created, is_active, description FROM Transaction WHERE id_user = 1");

$smtp->execute();


$smtp->store_result();

$smtp->bind_result($id_user, $type, $amount, $created, $is_active, $description);

//amount , type, created, is_active, description
while ($smtp->fetch()) {
    $ret[$count][0] =  $id_user;
    $ret[$count][1] =  $type;
    $ret[$count][2] =  $amount;
    $ret[$count][3] =  $created;
    $ret[$count][4] =  $is_active;
    $ret[$count][5] =  $description;

    $count++;
}
//echo "test 3";

$smtp->free_result();
//



$saldos = [];

/* REGRESA INGRESO TOTAL Y EGRESO TOTAL*/
$smtp = $mysqli->prepare("SELECT Sum(b.amount), Sum(c.amount) FROM mxhacks.Transaction a
	LEFT JOIN mxhacks.Transaction b
	ON a.id_trans = b.id_trans
	AND b.type = 1 AND b.is_active = 1
	LEFT JOIN mxhacks.Transaction c
	on a.id_trans = c.id_trans
	AND c.type = 2 AND c.is_active = 1");
$smtp->execute();
$smtp->store_result();

$smtp->bind_result($ingresos, $egresos);

while($smtp->fetch()){
    $saldos[0][0] =  $ingresos;
    $saldos[0][1] =  $egresos;
}
$saldo = $saldos[0][0] - $saldos[0][1];
$smtp->free_result();



$smtp->close();

 ?>




    <div class="container">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>


        <h1>Resumen</h1>



        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail">

                    <div class="caption">
                        <h3>Thumbnail label</h3>
                        <p>...</p>
                    </div>
                </div>
            </div>
        </div>

        <h2>"Detallado"</h2>


        <h2 style="color: #468847;">Ingresos</h2>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Descripcion</th>

            </tr>
            </thead>
            <tbody>

            <?php
            //amount , type, created, is_active, description
            foreach($ret as $trans){
                

                /*
                 *
                 *  $ret[$count][0] =  $id_user;
    $ret[$count][1] =  $type;
    $ret[$count][2] =  $amount;
    $ret[$count][3] =  $created;
    $ret[$count][4] =  $is_active;
    $ret[$count][5] =  $description;
                 */
                if($trans[4] == "1" && $trans[1] == "1") {
                    echo '<tr>';
                    echo '<td>' . $trans[2] . '</td>';
                    echo '<td>' . $trans[3]  . '</td>';
                    echo '<td>' . $trans[5]  . '</td>';
                    echo '</tr>';
                }
            }

            ?>


            </tbody>
        </table>


        <h2 style="color: #C26047;">Egresos</h2>


        <table class="table table-striped">
            <thead>
            <tr>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Descripcion</th>

            </tr>
            </thead>
            <tbody>

            <?php
            //amount , type, created, is_active, description
            foreach($ret as $trans){


                /*
                 *
                 *  $ret[$count][0] =  $id_user;
    $ret[$count][1] =  $type;
    $ret[$count][2] =  $amount;
    $ret[$count][3] =  $created;
    $ret[$count][4] =  $is_active;
    $ret[$count][5] =  $description;
                 */
                if($trans[4] == "1" && $trans[1] == "2") {
                    echo '<tr>';
                    echo '<td>' . $trans[2] . '</td>';
                    echo '<td>' . $trans[3]  . '</td>';
                    echo '<td>' . $trans[5]  . '</td>';
                    echo '</tr>';
                }
            }

            ?>


            </tbody>
        </table>



    </div>




<?php

include ("foot.php")

?>