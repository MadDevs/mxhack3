  <?php include('./includes/conn.php'); 

    $namePersona = $_POST['namePersona'];
    $intervalo = $_POST['intervalo'];
    $nameTanda = $_POST['name'];
    $numRep = $_POST['numRep'];
    $numPeople = $_POST['numPeople'];
    $cantidad = $_POST['cantidad'];

    foreach( $namePersona as $key => $value ) {
      //echo $value;
    }


    $today = date("Y-m-d"); //getdate converted day

    $mysqli = con_start();
    $id_user = 1;
    $smtp = $mysqli->prepare("INSERT INTO Tanda(id_user, name, intervalo_dias, num_personas, num_repeticiones, cantidad, fecha_inicial) VALUES (?,?,?,?,?,?,?) ");
    
    $smtp->bind_param("isiiiis", $id_user, $intervalo, $numPeople, $numRep, $cantidad, $today);
    $smtp->execute();
 
    if (!$smtp->error) {
      echo "correct"  ;
    }
    else {
      echo "error" . $smtp->error;
    }
    $smtp->close();
    
    

  ?>  
