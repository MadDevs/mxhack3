    <?php include('./includes/conn.php');

    $titulo = "Resumen";
    include ("head.php");

    setlocale(LC_MONETARY, 'en_US');
    $mysqli = con_start();

    $id = 1;
    $smtp = $mysqli->prepare("SELECT t.amount, t.monthly,
      EXTRACT(MONTH FROM t.created), t.created, t.id_trans
      FROM Transaction t
      WHERE t.id_user = ? AND t.is_active = 1");

    $smtp->bind_param("i", $id);
    $smtp->execute();
    $smtp->store_result();
    $smtp->bind_result($amount, $monthly, $month, $date, $idt);

    while ($smtp->fetch()) {
      if($monthly == 1){
         $arrI[$month][] =  $amount;
      } elseif($monthly == 0){
         $arrE[$month][] =  $amount;
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


<div class="container">

    <?php
    for(int $i = 1; $i < 13; $i++){
      if((count($arrI[$i]) > 0) || (count($arrE[$i]) > 0)){
        echo
        "<div class='row'>".
          "<div class='row'>".$i."</div>".
          "<div class='row'>".
            "<div class='col-md-6' style='color:green;'>Ingreso</div>".
            "<div class='col-md-6' style='color:red;'>Egreso:</div>".
          "</div>".
          "<div class='row'>".
            "<div class='col-md-6' style='color:green;'>";
            for(int $j = 0; $j < count($arrI[$i]); $j++){
              echo
                "<div class='row' style='color:green;'>+ ".
                  $arrI[$i][$j]."</div>"
            }

          echo
            "</div>".
            "<div class='col-md-6' style='color:red;'>";
            for(int $j = 0; $j < count($arrE[$i]); $j++){
              echo
                "<div class='row' style='color:red;'>- ".
                  $arrE[$i][$j]."</div>"
            }
          echo
            "</div>".
          "</div>".
        "</div>";
      }
    }
    ?>

</div>

<?php  include("foot.php") ?>

