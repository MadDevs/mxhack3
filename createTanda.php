  <?php include('./includes/conn.php'); 

    $namePersona = $_POST['namePersona'];
    $intervalo = $_POST['intervalo'];
    $nameTanda = $_POST['nameTanda'];
    $numRep = $_POST['numRep'];
    $numPeople = $_POST['numPeople'];
    $cantidad = $_POST['cantidad'];
    $turno = $_POST['turno'];
    $today = date("Y-m-d"); //getdate converted day
    $id_user = 1;

    



    $mysqli = con_start();
    $smtp = $mysqli->prepare("INSERT INTO Tanda(id_user, name, intervalo_dias, num_personas, num_repeticiones, cantidad, fecha_inicial) VALUES (?,?,?,?,?,?,?) ");
    $smtp->bind_param("isiiiis", $id_user,$nameTanda, $intervalo, $numPeople, $numRep, $cantidad, $today);
    $smtp->execute();
    if (!$smtp->error) {
      echo "correct"  ;
    }
    else {
      echo "error" . $smtp->error;
    }
    $smtp->close();
    
    $id_tanda = 1;
    // Id de tanda que se acaba de insertar
    $mysqli = con_start();
    $smtp = $mysqli->prepare("SELECT id_tanda FROM Tanda ORDER BY id_tanda DESC LIMIT 1");
    $smtp->execute();
    $smtp->store_result();   
    $smtp->bind_result($id_tand);
    while ($smtp->fetch()) {
        $id_tanda = $id_tand;
    }
    $smtp->free_result();
    $smtp->close();



    foreach( $namePersona as $key => $value ) {
      $mysqli = con_start();
      $smtp = $mysqli->prepare("INSERT INTO UsuariosTanda(id_tanda, nombre, turn) VALUES (?,?,?) ");
      $smtp->bind_param("isi", $id_tanda,$value, $turno[$key]);
      $smtp->execute();
      if (!$smtp->error) {
        echo "correct"  ;
      }
      else {
        echo "error" . $smtp->error;
      }
      $smtp->close();
    }

    

  ?>  
