  <?php include('./includes/conn.php'); 
    echo "test";
    $mysqli = con_start();
    $ret = [];
    $count = 0;

    $id = 1;
    $smtp = $mysqli->prepare("SELECT u.id_user, u.first_name FROM User u WHERE u.user_id = ?");
    var_dump(error_get_last());
    $smtp->bind_param("i", $id);
    
    var_dump(error_get_last());
    $smtp->execute();
    $smtp->store_result();    
    var_dump(error_get_last());
    $smtp->bind_result($id, $first_name);
    while ($smtp->fetch()) {
         $ret[$count][0] =  $id;
         $ret[$count][1] =  $first_name;
         $count++;
    }
    var_dump(error_get_last());
    $smtp->free_result();
    $smtp->close();
    var_dump($ret);
  ?>  