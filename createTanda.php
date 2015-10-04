  <?php include('./includes/conn.php'); 

    $namePersona = $_POST['namePersona'];
    $intervalo = $_POST['intervalo'];
    $nameTanda = $_POST['name'];
    $numRep = $_POST['numRep'];
    $numPeople = $_POST['numPeople'];
    $cantidad = $_POST['cantidad'];

    var_dump($namePersona);
    foreach( $namePersona as $key => $value ) {
      echo $value;
    }
    echo "\n " . $namePersona . "\n";
    echo "\n " . $numPeople . "\n";
    echo "\n " . $cantidad . "\n";
    echo "\n " . $intervalo . "\n";
    echo "\n " . $nameTanda . "\n";
    echo date("Y-m-d");

    $mysqli = con_start();
    $ret = [];
    $count = 0;

    $id = 1;
    $smtp = $mysqli->prepare("INSERT INTO ");
    
    $smtp->bind_param("i", $id);
    $smtp->execute();
    $smtp->store_result();   
    $smtp->bind_result($id, $first_name);
    while ($smtp->fetch()) {
         $ret[$count][0] =  $id;
         $ret[$count][1] =  $first_name;
         $count++;
    }
    echo "test 3";
    $smtp->free_result();
    $smtp->close();
    var_dump($ret);
    

  ?>  
