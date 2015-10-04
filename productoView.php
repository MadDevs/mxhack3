<?php
/**
 * Created by PhpStorm.
 * User: Alfredo Hinojosa
 * Date: 10/4/2015
 * Time: 1:35 AM
 */
    include ("includes/conn.php");
    $title = "Productos deseados";
    include ("head.php");

    $mysqli = con_start();
    $ret = [];
    $count = 0;


    //$id = 1;
    $smtp = $mysqli->prepare("SELECT name, description, amount FROM Product WHERE id_user = 1");


    //$smtp->bind_param("i", $id);
    $smtp->execute();


    $smtp->store_result();
    $smtp->bind_result($name, $info, $cost);


    while ($smtp->fetch()) {
        $ret[$count][0] =  $id_tanda;
        $ret[$count][1] =  $info;
        $ret[$count][2] =  $cost;
        $count++;
    }

    $smtp->free_result();
    $smtp->close();

    var_dump($ret);
    // */

    // */

?>