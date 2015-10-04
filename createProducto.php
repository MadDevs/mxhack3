<?php include('./includes/conn.php');

    $nameProducto = "";
    $info = "";
    $cost = "";

    $nameProducto = $_POST['nameProducto'];
    $info = $_POST['description'];
    $cost = $_POST['amount'];
    $mysqli = con_start();
    $id_user = 1;
    $notCompleted = 0;

    $smtp = $mysqli->prepare("INSERT INTO Product(id_user, name, description, amount, completed, id_trans) VALUES (?,?,?,?,?,?)");
    $smtp->bind_param("issiii", $id_user, $nameProducto, $info, $cost, $notCompleted, $id_user);
    $smtp->execute();
    if (!$smtp->error) {
        echo "correct"  ;
    }
    else {
        echo "error" . $smtp->error; 
    }
    $smtp->close();

?>
