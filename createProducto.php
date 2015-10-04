<?php include('./includes/conn.php');

    $nameProducto = "";
    $info = "";
    $cost = "";
    $star = "";
    $id_user = 1;
    $notCompleted = 0;
    $fav = -1;

    $nameProducto = $_POST['nameProducto'];
    $info = $_POST['description'];
    $cost = $_POST['amount'];
    $star = $_POST['star'];

    if($star == 'f'){
        $fav = 1;
    } else {
        $fav = 0;
    }

    $mysqli = con_start();

    if($fav == 1){
        $smtp = $mysqli->prepare("UPDATE Product SET id_trans = 0 WHERE id_trans = 1");
        $smtp->execute();
        $smtp->free_result();
        $smtp->close();
    }

    $smtp = $mysqli->prepare("INSERT INTO Product(id_user, name, description, amount, completed, id_trans) VALUES (?,?,?,?,?,?)");
    $smtp->bind_param("issiii", $id_user, $nameProducto, $info, $cost, $notCompleted, $fav);
    $smtp->execute();
    if (!$smtp->error) {
        echo "correct"  ;
    }
    else {
        echo "error" . $smtp->error; 
    }
    $smtp->close();

?>
