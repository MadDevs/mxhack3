  <?php include('./includes/conn.php');
    setlocale(LC_MONETARY, 'en_US');
    $mysqli = con_start();
    $countM = 0;
    $countI = 0;

    $id = 1;
    $smtp = $mysqli->prepare("SELECT t.amount, t.monthly,
      EXTRACT(MONTH FROM t.created), t.created, t.id
      FROM Transaction t
      WHERE t.id_user = ? AND t.is_active = 1");

    $smtp->bind_param("i", $id);
    $smtp->execute();
    $smtp->store_result();
    $smtp->bind_result($amount, $monthly, $month, $date, $idt);

    while ($smtp->fetch()) {
      if($monthly == 1){
         $retM[$countM][0] = $amount;
         $retM[$countM][1] = $idt;
         $countM++;
      } elseif($monthly == 0){
         #$retI[$month][] =  $amount;
         $retI[$month][] =  array($amount, $idt);
      }
    }
    $smtp->free_result();
    $smtp->close();

    function getMonth ($i){
        switch ($i) {
            case 1:
                return "Enero";
            case 2:
                return "Febrero";
            case 3:
                return "Marzo";
            case 4:
                return "Abril";
            case 5:
                return "Mayo";
            case 6:
                return "Junio";
            case 7:
                return "Julio";
            case 8:
                return "Agosto";
            case 9:
                return "Septiembre";
            case 10:
                return "Octubre";
            case 11:
                return "Noviembre";
            case 12:
                return "Diciembre";
        }
    }
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
      echo "<div class='row'>+ ".money_format('%(#5n',$retM[$i][0]).
        "<button class='remove' data-id='1' value='Quitar ganancia'>".
        "</div>";
    }
  ?>

      </div>
      <div class="mdl-card__actions mdl-card--border">

        <!-- button -->
        <form>
          <input type="text" name="money" placeholder="100" style="color:black;">
          <input type="submit" value="Agrega dinero mensual"
            class="mdl-button mdl-js-button mdl-js-ripple-effect"
            style="color:green;">
        </form>

    </div>
  </div>

  <div class="col-md-6">
  <?php
     for($i = 0; $i < 13; $i++){
       if(count($retI[$i]) > 0){
         echo
         "<div class='mdl-card mdl-shadow--2dp'>".
           "<div class='mdl-card__title mdl-card--expand'>".
             #title
           "<h2 class='mdl-card__title-text'>".getMonth($i).
           "</h2>".
           "</div>".
           "<div class='mdl-card__supporting-text'>";
             #body
             for($j = 0; $j < count($retI[$i]); $j++){
               echo "<div class='row'>+ ".money_format('%(#5n',$retI[$i][$j][0])."</div>";
             }
         echo
           "</div>".
           #button
           "<div class='mdl-card__actions mdl-card--border'>".
             "<a class='mdl-button mdl-js-button mdl-js-ripple-effect' style='color:green;'>".
               "Agrega dinero a ".getMonth($i).
             "</a>".
           "</div>".
         "</div>";
       }
     }
   ?>


  </div>
</div>

</body>
    <script>
    $('.remove').on('click', function (e) {

      console.log(this);
      e.preventDefault();

      /*
      $.ajax({
        type: 'post',
        url: 'removeTransaction.php',
        data: $('#addTanda').serialize(),
        success: function (json) {
            alert(json);

        }
       */
    });
    </script>
</html>
