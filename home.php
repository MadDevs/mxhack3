<?php

    include ("includes/conn.php");
    $saldos = [];
    $saldo = 0;
    $fechaTanda = "";
    $producto = "";
    $deudas = 0;

    echo "Empieza";
    /* REGRESA INGRESO TOTAL Y EGRESO TOTAL*/
    $smtp = $mysqli->prepare("SELECT Sum(b.amount), Sum(c.amount) FROM mxhacks.Transaction a
	LEFT JOIN mxhacks.Transaction b
	ON a.id_trans = b.id_trans
	AND b.type = 1
	LEFT JOIN mxhacks.Transaction c
	on a.id_trans = c.id_trans
	AND c.type = 2");
    $smtp->execute();
    echo "done";
    $smtp->store_result();

    $smtp->bind_result($ingresos, $egresos);

    echo "Antes while";
    while($smtp->fetch()){
        $saldos[0][0] =  $ingresos;
        $saldos[0][1] =  $egresos;
    }

    $smtp->free_result();
    $smtp->close();

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

    <title>Bienvenido ></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="css/cover.css" rel="stylesheet">

    <!-- Material design content -->
    <link rel="stylesheet" href="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.green-light_green.min.css" />
    <script src="https://storage.googleapis.com/code.getmdl.io/1.0.5/material.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        h4{
            color:#fff;
        }

        .demo-card-event.mdl-card {
            width: 240px;
            height: 240px;
            margin-left: 20px;
            margin-top: 20px;
            background: #03A9F4;
            float: left;
        }
        .demo-card-event > .mdl-card__actions {
            border-color: rgba(255, 255, 255, 0.2);
        }

        .demo-card-event > .mdl-card__title {
            align-items: flex-start;
        }
        .demo-card-event > .mdl-card__title > h4 {
            margin-top: 0;
        }
        .demo-card-event > .mdl-card__actions {
            display: flex;
            box-sizing:border-box;
            align-items: center;
        }
        .demo-card-event > .mdl-card__title,
        .demo-card-event > .mdl-card__actions,
        .demo-card-event > .mdl-card__actions > .mdl-button {
            color: #fff;
        }
    </style>
</head>

<body>

<div class="site-wrapper">
    <div class="site-wrapper-inner">
        <div class="cover-container">
            <div class="masthead clearfix">
                <div class="inner">
                    <h3 class="masthead-brand">Inicio - Bienvenido a tu cochinito</h3>
                    <nav>
                        <ul class="nav masthead-nav">
                            <li><a href="#">Ayuda</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- CARDS SPACE -->
            <div class="inner cover">
                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#4BAF4F">
                        <div class="mdl-card__title mdl-card--expand">
                            <h4>Ingresos<br>
                                Tienes <br>
                                $ <?php echo $saldos[0][0]?>
                            </h4>
                        </div>
                        <div class="mdl-card__actions mdl-card--border">
                            <a href="ingress.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                                Ir a ingresos
                            </a>
                            <div class="mdl-layout-spacer"></div>
                        </div>
                </div>

                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#3F51B5">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4>Egresos<br>
                            Debes<br>
                            $ <?php echo $saldos[0][1]?>
                        </h4>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="egress.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Ir a egresos
                        </a>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </div>

                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#E91E63">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4>
                            Resumen<br>
                            Tu saldo real<br>
                            $ 1,500
                        </h4>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="resumen.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Ir a resumen
                        </a>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </div>

                <br>

                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#FF5722">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4>
                            Tanda<br>
                            Te toca el<br>
                            4 de octubre
                        </h4>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="tandasView.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                           Ir a tanda
                        </a>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </div>

                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#FFC107">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4>
                            Productos<br>
                            Actualmente quieres<br>
                            Bicicleta mono
                        </h4>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="productoView.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Ir a productos
                        </a>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </div>

                <div class="demo-card-event mdl-card mdl-shadow--2dp" style="background:#CDDC39">
                    <div class="mdl-card__title mdl-card--expand">
                        <h4>
                            Deudas<br>
                            Dinero que me deben<br>
                            $ 3,000
                        </h4>
                    </div>
                    <div class="mdl-card__actions mdl-card--border">
                        <a href="deudas.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
                            Ir a deudas
                        </a>
                        <div class="mdl-layout-spacer"></div>
                    </div>
                </div>

            <!-- CARDS SPACE -->
        </div>
    </div>
</div>
</div>

</body>
</html>
