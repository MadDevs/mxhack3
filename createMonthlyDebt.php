<?php include('./includes/conn.php');

    $idu = $_POST['idu'];
    $amount = $_POST['amount'];
    $time = date("Y-m-d");

    $return = 0;
    $two = 2;
    $one = 1;
    $mysqli = con_start();
    $smtp = $mysqli->prepare("INSERT INTO Transaction (id_user, type, amount, monthly, created)
      VALUES(?,?,?,?,?)");
    $smtp->bind_param("iiiis",$idu,$two, $amount,$one, $time);
    $smtp->execute();

    if (!$smtp->error) {
        $return = 1;
      }
      else {
        $return = 0;
      }
    $smtp->close();
    $id_trans = 0;
    if ($return == 1 ) {


	    // Id de tanda que se acaba de insertar
	    $mysqli = con_start();
	    $smtp = $mysqli->prepare("SELECT id_trans FROM Transaction ORDER BY id_trans DESC LIMIT 1");
	    $smtp->execute();
	    $smtp->store_result();   
	    $smtp->bind_result($id_tand);
	    while ($smtp->fetch()) {
	        $id_trans = $id_tand;
	    }
	    $smtp->free_result();
	    $smtp->close();

    }
    echo $id_trans;


?>
