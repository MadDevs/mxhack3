<?php include('./includes/conn.php');

    $nameProducto = "";
    $info = "";
    $cost = "";

    $nameProducto = $_POST['name'];
    $info = $_POST['description'];
    $cost = $_POST['amount'];


    $mysqli = con_start();
    $id_user = 1;



    $smtp = $mysqli->prepare("INSERT INTO Product(id_user, name, description, amount, completed, id_trans) VALUES (?,?,?,?,?,?)");

    $smtp->bind_param("issiii", $id_user, $nameProducto, $info, $cost, $id_user, $id_user);

    $smtp->execute();


    if (!$smtp->error) {
        echo "correct"  ;
    }
    else {
        echo "error" . $smtp->error . $name; 
    }
    $smtp->close();

?>
