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
//echo "test 3";


$smtp->free_result();
$smtp->close();

var_dump($ret);
// */

// */


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Tandas</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <?php
    //echo '<button type="button" class="btn btn-primary btn-lg btn-block">$ret[0]</button>';
    foreach($ret as $ok){
        echo '<button type="button" class="btn btn-primary btn-lg btn-block"> ' +$ok[0] +'</button>';
    }


    ?>



</div>



</body>


</html>