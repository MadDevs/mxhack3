<?php include('./includes/conn.php');


    $nameProducto = $_POST['name'];
    $info = $_POST['description'];
    $cost = $_POST['amount'];


    $mysqli = con_start();
    $id_user = 1;

    echo "</br> " . $nameProducto . "</br>";
    echo "</br> " . $info . "</br>";
    echo "</br> " . $cost . "</br>";
    echo "</br> " . $id_user . "</br>";

    $smtp = $mysqli->prepare("INSERT INTO Product(id_user, name, description, amount, completed, id_trans) VALUES (?,?,?,?,?,?)");
    echo "INSERT INTO Product(id_user, name, description, amount, completed, id_trans) VALUES ($id_user, $nameProducto, $info, $cost, 1, 1)";
     printf("Error: %s.\n", mysqli_stmt_error($stmt));
    $smtp->bind_param("issiii", $id_user, $nameProducto, $info, $cost, 1, 1);
     printf("Error: %s.\n", mysqli_stmt_error($stmt));
    $smtp->execute();


    if (!$smtp->error) {
        echo "correct"  ;
    }
    else {
        echo "error" . $smtp->error;
    }
    $smtp->close();

?>
