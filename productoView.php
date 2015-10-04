<?php
/**
 * Created by PhpStorm.
 * User: Alfredo Hinojosa
 * Date: 10/4/2015
 * Time: 1:35 AM
 */
include ("includes/conn.php");
$title = "Productos deseados";
include ("head.php");

$mysqli = con_start();
$notYet = [];
$done = [];
$favorite = [];
$count1 = 0;
$count2 = 0;
    //$id = 1;
$smtp = $mysqli->prepare("SELECT id_product, name, description, amount, completed FROM Product WHERE id_user = 1
    AND id_trans = 0 AND hidden = 0");

$smtp->execute();

$smtp->store_result();
$smtp->bind_result($id, $name, $info, $cost, $completed);


while ($smtp->fetch()) {
    if($completed == 1){
        $done[$count2][0] =  $name;
        $done[$count2][1] =  $info;
        $done[$count2][2] =  $cost;
        $done[$count2][3] =  $id;

        $count2++;
    } else {
        $notYet[$count1][0] =  $name;
        $notYet[$count1][1] =  $info;
        $notYet[$count1][2] =  $cost;
        $notYet[$count2][3] =  $id;
        $count1++;
    }
}

$smtp->free_result();


$smtp = $mysqli->prepare("SELECT name, description, amount, completed FROM Product WHERE id_user = 1
    AND id_trans = 1 AND hidden = 0");
$smtp->execute();
$smtp->store_result();
$count = 0;
$smtp->bind_result($name, $info, $cost, $completed);

while($smtp->fetch()){
    $favorite[0][0] =  $name;
    $favorite[0][1] =  $info;
    $favorite[0][2] =  $cost;
    $count++;
}

$smtp->free_result();
$smtp->close();

    //var_dump($ret);

?>
<div class="container">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php if ($count == 0) {?>
        <h2 id="heading" class="text-center">Favor de establecer producto objetivo</h2> 
    <?php }else{ ?>
    <h2 id="heading" class="text-center">Tu objetivo actual es comprar: <?php echo $favorite[0][0]?> con precio de $<?php echo $favorite[0][2]?></h2>
    <p><a class="btn btn-lg btn-success center-block" href="productoChart.php" role="button">&iquest;Cuanto me falta?</a></p>
    <?php } ?>
    <br>

    <h2>Estos son los productos que estan marcados como objetivos pr&oacute;ximos</h2>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Descripci&oacute;n</th>
            <th>Costo</th>
            <th>Marcar como favorito</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach($notYet as $ok){
            echo "<tr>";
            echo "<td>".$ok[0]."</td>";
            echo "<td>".$ok[1]."</td>";
            echo "<td id='".str_replace(" ", "", $ok[0])."'>$".$ok[2]."</td>";
            echo "<td><button id='".$ok[0]."' type='button' class='btn btn-default btn-lg center-block addFav'><span class='glyphicon glyphicon-star' aria-hidden='true'></span></button></td>";
            echo "<td><button id='".$ok[0]."' type='button' class='btn btn-default btn-lg center-block deleteProd'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p><a class="btn btn-lg btn-primary" href="producto.php" role="button">Agregar nuevo</a></p>

    <br><h2>Estos son los productos que has comprado, &iexcl;Felicidades!</h2>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Descripci&oacute;n</th>
            <th>Costo</th>
            <th>Eliminar</th>
        </tr>
        <?php
        foreach($done as $ok){
            echo "<tr id='".$ok[0]."'>";
            echo "<td>".$ok[0]."</td>";
            echo "<td>".$ok[1]."</td>";
            echo "<td>$".$ok[2]."</td>";
            echo "<td><button id='".$ok[0]."' type='button' class='btn btn-default btn-lg center-block deleteProd'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span></button></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <script type="text/javascript">

      $(document).ready(function() {
        $('#productoView').addClass("active");
      });

    $('.addFav').on('click', function (e) {
        var id = this.id;
        $.ajax({
          type: 'POST',
          url: './productoFunciones.php',
          data: {funcion: "addFav", idprod: id},
          success: function(dtx){
             console.log(dtx);
             var price = $("td#" + dtx.replace(" ", "")).html();
             $("#heading").text("Tu objetivo actual es comprar: " + dtx + " con precio de " + price);
         },
         error: function (json) {
            console.log(json);

        }
    });
    });

    $('.deleteProd').on('click', function (e) {
        var row = $(this);
        var id = this.id;
        $.ajax({
          type: 'POST',
          url: './productoFunciones.php',
          data: {funcion: "deleteProd", idprod: id},
          success: function(dtx){

             $(row).parent().parent().hide();
             console.log(dtx);
         },
         error: function (json) {
            console.log(json);

        }
    });
    });
    </script>
</div><!-- /.container -->

<?php  include("foot.php") ?>
