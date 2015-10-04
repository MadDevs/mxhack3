    <?php include('./includes/conn.php');

    $titulo = "Resumen";
    include ("head.php");

    setlocale(LC_MONETARY, 'en_US');

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
      echo "hello"
    }
    ?>

</div>

<?php  include("foot.php") ?>

