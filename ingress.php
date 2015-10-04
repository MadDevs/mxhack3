    <?php include('./includes/conn.php');

    $titulo = "Ingresos";
    include ("head.php");

    setlocale(LC_MONETARY, 'en_US');
    $mysqli = con_start();
    $countM = 0;
    $countI = 0;

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
         $retM[$countM][0] =  $amount;
         $retM[$countM][1] =  $idt;
         $countM++;
      } elseif($monthly == 0){
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


<div class="container">

    <div class="row">
      <div class="col-md-6 mdl-card mdl-shadow--2dp">

          <div class="mdl-card__title mdl-card--expand">

            <!-- title -->
            <h2 class="mdl-card__title-text">Ganancia de cada mes</h2>

          </div>
          <div class="mdl-card__supporting-text monthly_ingress">

            <!-- body -->
      <?php
        for($i = 0; $i < count($retM); $i++){
          echo "<div class='row'>+ ".money_format('%(#5n',$retM[$i][0]).
            "<button class='remove' data-id='".$retM[$i][1]."' value='remove' style='color:red;'>Quitar ganancia</button>".
            "</div>";
        }
      ?>

          </div>
          <div class="mdl-card__actions mdl-card--border">

            <!-- button -->
            <input id="ingresoFijo" class="monthlyInput"  type="text" name="amount" placeholder="100" style="color:black;">
            <button value="Agrega dinero mensual" style="color:green;"
              class="insertMonthly mdl-button mdl-js-button mdl-js-ripple-effect"
              data-idu='1'>

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
                  echo
                    "<div class='row'>+ ".money_format('%(#5n',$retI[$i][$j][0]).
                      "<button class='remove' data-id='".$retI[$i][$j][1]."' value='remove' style='color:red;'>Quitar ganancia</button>".
                      "</div>";
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

        <!-- button -->
        <input class="monthly_input" type="text" name="money" placeholder="100" style="color:black;">
        <button value="Agrega dinero mensual" style="color:green;"
          class="insertMonthly mdl-button mdl-js-button mdl-js-ripple-effect"
          data-idu='1'>

      </div>
    </div>

</div>

    <script>
      $('.insertMonthly').on('click', function (e) {

        e.preventDefault();
        var idu = $(this).attr('data-idu');
        var row = $('.monthly_ingress');
        var amount = $('#ingresoFijo').val();
        var button = $(this);
        $.ajax({
          type: 'post',
          url: './createMonthlyTransaction.php',
          data: {idu:idu, amount: amount},
          success: function (json) {
            
            if ($.trim(json)!=0) {
              var addition = "<div class='row'>+ "+ amount+".00 <button class='remove' data-id='"+$.trim(json)+"' value='remove' style='color:red;'>Quitar ganancia</button></div>";
              alert(addition);
              $(row).innerHTML += row;
              
             
            }

          }
      });

    });

      $('.remove').on('click', function (e) {

        e.preventDefault();
        var id = $(this).attr('data-id');
        var button = $(this);

        $.ajax({
          type: 'post',
          url: './removeTransaction.php',
          data: {id:id},
          success: function (json) {
              $(button).parent().hide();
              console.log(button);

          },
          error: function (json) {
            console.log(json);

          }
      });

    });
</script>

<?php  include("foot.php") ?>

