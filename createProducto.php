<?php include('./includes/conn.php');

    $nameProducto = "";
    $info = "";
    $cost = "";

    $nameProducto = $_POST['name'];
    $info = $_POST['description'];
    $cost = $_POST['amount'];

    echo "\n " . $nameProducto . "\n";
    echo "\n " . $info . "\n";
    echo "\n " . $cost . "\n";

    $mysqli = con_start();
    $id_user = 1;

    $smtp = $mysqli->prepare("INSERT INTO Product(id_user, name,
              description, amount, completed, id_trans) VALUES (?,?,?,?,?,?) ");
    var_dump(error_get_last());
    $smtp->bind_param("issiii", $id_user, $nameProducto, $info, $cost, 1, 1);
    var_dump(error_get_last());
    $smtp->execute();


    if (!$smtp->error) {
        echo "correct"  ;
    }
    else {
        echo "error" . $smtp->error;
    }
    $smtp->close();

?>
