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



    <?php
    echo "hello";
    ?>


<?php  include("foot.php") ?>

