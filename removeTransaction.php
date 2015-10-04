<?php include('./includes/conn.php');

    $idt = $_POST['id'];

    $return = 0;

    $mysqli = con_start();
    $smtp = $mysqli->prepare("UPDATE Transaction SET is_active=0 WHERE id_trans=?");
    $smtp->bind_param($idt);
    $smtp->execute();
?>
