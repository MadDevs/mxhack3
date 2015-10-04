<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/3/15
 * Time: 9:47 PM
 */


/*
try {

    $DBH = new PDO("mysql:host=104.236.217.175;dbname=mxhacks", "root", "0"); //5o4G3oPFec


} catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
$result = $DBH->query("SELECT id_tanda, name, FROM Tanda WHERE id_user = 1");
$row = $result->fetch(PDO::FETCH_ASSOC);


echo $signo." | ";
echo $row['prediccion'];
*/

// /*

// /*

include('./includes/conn.php');

$mysqli = con_start();
$ret = [];
$count = 0;


//$id = 1;
$smtp = $mysqli->prepare("SELECT id_tanda, name FROM Tanda WHERE id_user = 1");


//$smtp->bind_param("i", $id);
$smtp->execute();


$smtp->store_result();
$smtp->bind_result($id_tanda, $name);


while ($smtp->fetch()) {
    $ret[$count][0] =  $id_tanda;
    $ret[$count][1] =  $name;


    $count++;
}
//echo "test 3"

$smtp->free_result();
$smtp->close();


?>

<?php
$titulo = "Elegir Tandas";
include ("head.php")
?>

<div class="container">

    <p>&nbsp</p>
    <p>&nbsp</p>
    <p>&nbsp</p>

    <h1>Crear una tanda</h1>

    <form action="tandas.php">

        <button name="tipo" value="nueva" type="submit" class="btn btn-primary btn-lg btn-block"> Crear una nueva tanda</button>

    </form>

    <p>&nbsp</p>
    <p>&nbsp</p>

    <h1>Selecciona el numero de tabla</h1>

    <div class="form-group">
        <?php

        foreach($ret as $tandas){
            echo '<form action="tandasSelect.php">';
            echo '<button name="tipo" value="'.$tandas[0].'" type="submit" class="btn btn-secondary btn-lg btn-block">'.$tandas[1].'</button>';
            echo '</form>';
            echo '<p>&nbsp</p>';
        }

        ?>
    </div>



</div>



<?php
include ("foot.php")
?>
