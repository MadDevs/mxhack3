    <?php include('./includes/conn.php');

    $titulo = "Resumen";
    include ("head.php");

    setlocale(LC_MONETARY, 'en_US');
    $mysqli = con_start();

    $id = 1;
    $smtp = $mysqli->prepare("SELECT t.amount, t.monthly,
      EXTRACT(MONTH FROM t.created)
      FROM Transaction t
      WHERE t.id_user = ? AND t.is_active = 1");

    $smtp->bind_param("i", $id);
    $smtp->execute();
    $smtp->store_result();
    $smtp->bind_result($amount, $monthly, $month);

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
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <?php
    for($i = 1; $i < 13; $i++){
      if((count($arrI[$i]) > 0) || (count($arrE[$i]) > 0)){
        echo
        "<div class='row' style='padding:80px 0 0;'>".
          "<table class='table'><thead><th>".getMonth($i)."</th></thead>".
          "<tbody>".
            "<div class='row'>".

              "<div class='col-md-6'>".
                "<table class='table'><thead><th style='color:green;'>Ingreso</th></thead>".
                "<tbody>".
                  for($j = 0; $j < count($arrI[$i]); $j++){
                    echo
                      "<td style='color:green;'>+ ".
                        $arrI[$i][$j]."</td>";
                  }
                "</tbody>".
              "</div>".

              "<div class='col-md-6'>".
                "<table class='table'><thead><th style='color:red;'>Egreso</th></thead>".
                "<tbody>".
                  for($j = 0; $j < count($arrE[$i]); $j++){
                    echo
                      "<td style='color:red;'>+ ".
                        $arrE[$i][$j]."</td>";
                  }
                "</tbody>".
              "</div>".
            "</div>".
          "</tbody>".
        "</table>".
      "</div>";
      }
    }
    ?>

</div>

<?php  include("foot.php") ?>

