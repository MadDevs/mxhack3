<?php include('./includes/conn.php');

    $idu = $_POST['idu'];
    $amount = $_POST['amount'];
    $time = date("Y-m-d");

    $return = 0;
    $one = 1;
    $mysqli = con_start();
    var_dump(error_get_last());
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created) VALUES(?,?,?,?,?)");
    var_dump(error_get_last());
    $smtp->bind_param("iiiis",$idu,$one, $amount,$one, $time);
    var_dump(error_get_last());
    $smtp->execute();
    var_dump(error_get_last());
    $smtp->close();

    var_dump(error_get_last());
?>
