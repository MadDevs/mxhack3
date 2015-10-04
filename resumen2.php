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
$smtp->close();



 ?>


    <div class="container">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1>Resumen</h1>



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
                if($trans[4] == "1") {
                    echo '<td>';
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