

<?php
    $titulo = "Tandas";
    include ("head.php")
?>



    <div class="container">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <h1>Tandas</h1>
        <h2>Agregar una nueva tanda</h2>
        <p class="bg-success" style="display: none; border-radius: 5px; text-align: center;" id="success">Tanda agregada correctamente</p>
        <p class="bg-error" style="display: none;   border-radius: 5px; text-align: center;" id="error">Error al agregar tanda</p>
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
                    <input type="number" name="intervalo" class="form-control" id="intervalo" placeholder="Cada cuando se colecta dinero (días)">
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
                    <select class="form-control" id="turnoPersona" name="turnoPersona">
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
                    <button type="submit" class="btn btn-default">Agregar tanda</button>
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



$('#addTanda').on('submit', function (e) {

  e.preventDefault();

  $.ajax({
    type: 'post',
    url: 'createTanda.php',
    data: $('#addTanda').serialize(),
    success: function (json) {
        if ($.trim(json)==0) {

            setTimeout(function() {$("#success").show();}, 1000);
            setTimeout(function() {$("#success").hide();}, 5000);
            $('#nameTanda').val("");
            $('#intervalo').val("");
            $('#numRep').val("");
            $('#cantidad').val("");
            $('#numPeople').val("");
            $('#numPeople').trigger('keyup');    
        }
        else {
            setTimeout(function() {$("#error").show();}, 1000);
            setTimeout(function() {$("#error").hide();}, 5000);   
        }

    }
});

});


</script>


</div><!-- /.container -->

<?php  include("foot.php") ?>





