<?php include('./includes/conn.php');

    $idu = $_POST['idu'];
    $amount = $_POST['amount'];
    $time = date("Y-m-d");

    $return = 0;

    $mysqli = con_start();
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created)
      VALUES(?,1,?,1,?)");
    $smtp->bind_param($idu,$amount,$time);
    $smtp->execute();
?>
