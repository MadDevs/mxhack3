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
    $smtp = $mysqli->prepare("SELECT name, description, amount, completed FROM Product WHERE id_user = 1
        AND id_trans = 0");

    $smtp->execute();

    $smtp->store_result();
    $smtp->bind_result($name, $info, $cost, $completed);


    while ($smtp->fetch()) {
        if($completed == 1){
            $done[$count2][0] =  $name;
            $done[$count2][1] =  $info;
            $done[$count2][2] =  $cost;
            $count2++;
        } else {
            $notYet[$count1][0] =  $name;
            $notYet[$count1][1] =  $info;
            $notYet[$count1][2] =  $cost;
            $count1++;
        }
    }

    $smtp->free_result();


    $smtp = $mysqli->prepare("SELECT name, description, amount, completed FROM Product WHERE id_user = 1
        AND id_trans = 1");
    $smtp->execute();
    $smtp->store_result();
    $smtp->bind_result($name, $info, $cost, $completed);

    while($smtp->fetch()){
        $favorite[0][0] =  $name;
        $favorite[0][1] =  $info;
        $favorite[0][2] =  $cost;
    }

    $smtp->free_result();
    $smtp->close();

    //var_dump($ret);

?>
<div class="container">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

    <h2 class="text-center">Tu objetivo actual es comprar: <?php echo $favorite[0][0]?> con precio de $ <?php
        echo $favorite[0][2]?></h2>
    <p><a class="btn btn-lg btn-success" href="#" role="button">&iquest;Cuanto me falta?</a></p>
    <br>

    <h2>Estos son los productos que estan marcados como objetivos pr&oacute;ximos</h2>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Descripci&oacute;n</th>
            <th>Costo</th>
        </tr>
        <?php
        foreach($notYet as $ok){
            echo "<tr>";
            echo "<td>".$ok[0]."</td>";
            echo "<td>".$ok[1]."</td>";
            echo "<td>".$ok[2]."</td>";
            echo "</tr>";
        }
        ?>
    </table>
    <p><a class="btn btn-lg btn-primary" href="#" role="button">Agregar nuevo</a></p>

    <br><h2>Estos son los productos que has comprado, &iexcl;Felicidades!</h2>
    <table class="table">
        <tr>
            <th>Producto</th>
            <th>Descripci&oacute;n</th>
            <th>Costo</th>
        </tr>
        <?php
        foreach($done as $ok){
            echo "<tr>";
            echo "<td>".$ok[0]."</td>";
            echo "<td>".$ok[1]."</td>";
            echo "<td>".$ok[2]."</td>";
            echo "</tr>";
        }
        ?>
    </table>
</div><!-- /.container -->

<?php  include("foot.php") ?>
