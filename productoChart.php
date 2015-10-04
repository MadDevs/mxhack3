
<?php
include ("includes/conn.php");
$titulo = "Nuevo objetivo";
include ("head.php");

$mysqli = con_start();
$favorite = [];

$smtp = $mysqli->prepare("SELECT name, description, amount, completed FROM Product WHERE id_user = 1 id_trans = 1");
var_dump(error_get_last());
$smtp->execute();
var_dump(error_get_last());
$smtp->store_result();
var_dump(error_get_last());
$smtp->bind_result($name, $info, $cost, $completed);
var_dump(error_get_last());
while($smtp->fetch()){
	var_dump(error_get_last());
	$favorite[0][0] =  $name;
	var_dump(error_get_last());
	$favorite[0][1] =  $info;
	var_dump(error_get_last());
	$favorite[0][2] =  $cost;
	var_dump(error_get_last());
}
var_dump(error_get_last());

$smtp->free_result();
var_dump(error_get_last());
$smtp->close();

var_dump(error_get_last());
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<center>
	<div id="chart_div"></div>
</center>
<script type="text/javascript">

google.load('visualization', '1', {packages: ['corechart', 'line']});
google.setOnLoadCallback(drawBasic);

function drawBasic() {

	var data = new google.visualization.DataTable();
	data.addColumn('date', 'Months');
	data.addColumn('number', 'Cantidad de ahorrar al mes');
	data.addColumn('number', 'Historial de ahorro');

	var dataDate = [
	new Date(2014, 0),
	new Date(2014, 1),
	new Date(2014, 2),
	new Date(2014, 3),
	new Date(2014, 4),
	new Date(2014, 5),
	new Date(2014, 6),
	new Date(2014, 7),
	new Date(2014, 8),
	new Date(2014, 9),
	new Date(2014, 10),
	new Date(2014, 11),
	new Date(2015, 0),
	new Date(2015, 1),
	new Date(2015, 2),
	new Date(2015, 3),
	new Date(2015, 4),
	new Date(2015, 5),
	new Date(2015, 6),
	new Date(2015, 7),
	new Date(2015, 8),
	new Date(2015, 9),
	new Date(2015, 10),
	new Date(2015, 11)
	];

	var dataArray = new Array();

	for (var i = 0; i < dataDate.length; i++) {
		if (i <= dataDate.length / 4){
			var temp = new Array(dataDate[i], i * 10, i * 9 + 4.5 * Math.pow(-1, i));
		}
		else{
			var temp = new Array(dataDate[i], i * 10, null);
		}
		dataArray.push(temp);
	}
	console.log(dataDate);
	console.log(dataArray);

	data.addRows(dataArray);		

	var options = {
		title: 'Tu objetivo actual es comprar:' + <?php echo $favorite[0][0]?> + ' con precio de $ ' +
		<?php echo $favorite[0][2]?>,
		hAxis: {
			title: 'Time',
			ticks: dataDate
		},
		lineWidth: 10,
		lineDashStyle: [5, 1, 5],
		animation: {
			startup: true,
			duration: 1000
		},
		vAxis: {
			title: 'MONIES'
		},
		width: 900,
		height: 500
	};

	var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

	chart.draw(data, options);
}

</script>
<?php  include("foot.php") ?>