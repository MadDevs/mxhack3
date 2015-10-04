<?php include('./includes/conn.php');

    $idu = $_POST['idu'];
    $amount = $_POST['amount'];
    $time = date("Y-m-d");

    $return = 0;
    $one = 1;
    $mysqli = con_start();
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created)
      VALUES(?,?,?,?,?)");
    $smtp->bind_param("iiiis",$idu,$one, $amount,$one, $time);
    $smtp->execute();

    $smtp->close();
?>
