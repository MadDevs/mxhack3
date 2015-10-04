  <?php include('./includes/conn.php');
    $mysqli = con_start();
    $ret = [];
    $countM = 0;
    $countI = 0;

    $id = 1;
    $smtp = $mysqli->prepare("SELECT t.amount, t.monthly,
      EXTRACT(MONTH FROM t.created), t.created
      FROM Transaction t
      WHERE t.id_user = ? AND t.is_active = 1");

    $smtp->bind_param("i", $id);
    $smtp->execute();
    $smtp->store_result();
    $smtp->bind_result($amount, $monthly, $month, $date);

    while ($smtp->fetch()) {
      $toZero = $month;
      if($monthly == 1){
         $retM[$countM][0] =  $amount;
         $countM++;
      } elseif($monthly == 0){
         $retI[$month-$toZero][] =  $amount;
      }
    }
    $smtp->free_result();
    $smtp->close();
    var_dump(retI);
  ?>

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ingresos</title>

    <!-- Google material css -->
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.light_green-amber.min.css" />
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

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

<div class="row"></div>
<div class="row">
  <div class="col-md-6 mdl-card mdl-shadow--2dp">

      <div class="mdl-card__title mdl-card--expand">

        <!-- title -->
        <h2 class="mdl-card__title-text">Ganancia de cada mes</h2>

      </div>
      <div class="mdl-card__supporting-text">

        <!-- body -->
  <?php
    for($i = 0; $i < count($retM); $i++){
        echo "<div class='row'>+ ".$retM[$i][0]."</div>";
    }
  ?>

      </div>
      <div class="mdl-card__actions mdl-card--border">

        <!-- button -->
        <a class="mdl-button mdl-js-button mdl-js-ripple-effect" style="color:green;">
          Agrega dinero
        </a>

    </div>
  </div>

  <div class="col-md-6">



  </div>
</div>

</body>
</html>
