
<?php
/**
 * Created by PhpStorm.
 * User: enriqueohernandez
 * Date: 10/3/15
 * Time: 7:04 PM
 */

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

    <title>Tandas</title>

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

    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Project name</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>




    <div class="container">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1>Tandas</h1>
        <h2>Agregar una nueva tanda</h2>

        <form id="addTanda" class="form-horizontal" action="createTanda.php" method="POST">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Nombre de la tanda</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nameTanda" id="nameTanda" placeholder="Nombre de la tanda">
                </div>
            </div>

            <!--seleccionar tipos de tandas -->
            <div class="form-group">
                <label for="Intervalo" class="col-sm-2 control-label">Intervalo</label>
                <div class="col-sm-10">


                    <select class="form-control" id="intervalo" name="intervalo">
                        <option value="1" id="intervalo1">1 semana</option>
                        <option value="2" id="intervalo2">2 semanas</option>
                        <option value="3" id="intervalo3">1 mes</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="numRep" class="col-sm-2 control-label">Numero de repeticiones</label>
                <div class="col-sm-10">
                    <input type="number" name="numRep" class="form-control" id="numRep" placeholder="Numero de repeticiones">
                </div>
            </div>

            <div class="form-group">
                <label for="cantidad" class="col-sm-2 control-label">Cantidad $</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad $">
                </div>
            </div>

            <div class="form-group">
                <label for="numPeople" class="col-sm-2 control-label">Numero de personas</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="numPeople" id="numPeople" placeholder="Numero de personas">
                </div>
            </div>

            <div class="form-group">
                <label for="Intervalo" class="col-sm-2 control-label">Tu turno de Tanda</label>
                <div class="col-sm-10">
                    <select class="form-control" id="turno" name="turno">
                        <option value="1" selected>1</option>
                    </select>
                </div>
            </div>

            <div class="form-group" id="personas">

            </div>

            <p>&nbsp;</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <div class="form-group text-center">
                <div>
                    <button type="submit" class="btn btn-default">Sign in</button>
                </div>
            </div>
        </form>

        <script>
        $("#numPeople").keyup(function() {
            var number =  $("#numPeople").val();

            $("#turno").empty();
            for (var i = 1; i <= number && i < 9; i++) {
                $('#turno').append($('<option>', {
                    value: i,
                    text: i
                }));
            };

            $("#personas").empty();
            var strDiv = "";
            for (var i = 1; i < number && i < 9; i++) {
                strDiv += "<label for='namePersona[]' class='col-sm-2 control-label'>Nombre " + i + " </label>";
                strDiv += "<div class='col-sm-6'>";
                strDiv += "<input type='text' class='form-control' name='namePersona[]' id='namePersona' placeholder='Nombre de la Persona " + i + "'>";
                strDiv += "</div><label for='namePersona[]' class='col-sm-1 control-label'>Turno</label>";
                strDiv += "<div class='col-sm-3'><select class='form-control' id='turno" + i + "' name='turno[]'></select>";
                strDiv += "</div><br><br>";
            };
            $("#personas").append(strDiv);

            for (var i = 1; i < number && i < 9; i++) {
                $("#turno" + i).empty();
                for (var j = 1; j <= number && j < 9; j++) {
                    $('#turno' + i).append($('<option>', {
                        value: j,
                        text: j
                    }));
                };
            };
        });



$('addTanda').on('submit', function (e) {

  e.preventDefault();

  $.ajax({
    type: 'post',
    url: 'createTanda.php',
    data: $('#addTanda').serialize(),
    success: function (json) {
        alert(json);

    }
});

});


</script>


</div><!-- /.container -->

</body>
</html>





