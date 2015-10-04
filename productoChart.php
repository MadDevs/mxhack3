
<?php
include ("includes/conn.php");
$titulo = "Nuevo objetivo";
include ("head.php");
echo "start";
$mysqli = con_start();
echo "fav";
$favorite = [];

$smtp = $mysqli->prepare("SELECT name, description, amount, completed FROM Product WHERE id_user = 1 AND id_trans = 1");
echo "sql";
$smtp->execute();
$smtp->store_result();
$smtp->bind_result($name, $info, $cost, $completed);

while($smtp->fetch()){
	$favorite[0][0] =  $name;
	$favorite[0][1] =  $info;
	$favorite[0][2] =  $cost;
}

$smtp->free_result();

$finance = [];

$smtp = $mysqli->prepare("SELECT Sum(b.amount), Sum(c.amount) FROM mxhacks.Transaction a 
	LEFT JOIN mxhacks.Transaction b 
	ON a.id_trans = b.id_trans 
	AND b.type = 1 AND b.is_active = 1
	LEFT JOIN mxhacks.Transaction c 
	on a.id_trans = c.id_trans
	AND c.type = 2 AND c.is_active = 1");
echo "sql";
$smtp->execute();
$smtp->store_result();
$smtp->bind_result($income, $outcome);

while($smtp->fetch()){
	$finance[0] =  $income;
	$finance[1] =  $outcome;
}

$smtp->free_result();

$smtp->close();

var_dump(error_get_last());
?>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<br><br><br>
<div class="col-sm-2"></div>
<div class="col-sm-8 text-center">
	<div id="chart_div">
	</div>
</div>
<div class="col-sm-2"></div>
<div class="text-center col-sm-12">
	<button id="<?php echo $favorite[0][0]?>" class="completed">Producto adquirido</button>
</div>

<script type="text/javascript">

google.load('visualization', '1', {packages: ['corechart', 'line']});
google.setOnLoadCallback(drawBasic);

var productoCosto = <?php echo $favorite[0][2]?>;
var dineroAhorrado = <?php echo ($finance[0] - $finance[1])?>;

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
	var weeks = 20 //(weekDiff(new Date(2014, 0), new Date()));
	var costoSemanal = productoCosto / dataDate.length;
	var ahorroSemanal = dineroAhorrado / weeks;

	for (var i = 0; i < dataDate.length; i++) {
		if (i <= weeks){
			var temp = new Array(dataDate[i], (i + 1) * costoSemanal, ahorroSemanal * i);
		}
		else{
			var temp = new Array(dataDate[i], (i + 1) * costoSemanal, null);
		}
		dataArray.push(temp);
	}
	console.log(dataDate);
	console.log(dataArray);

	data.addRows(dataArray);		

	var options = {
		title: "<?php echo 'Tu objetivo actual es comprar: ' . $favorite[0][0] . ' con precio de $ ' . $favorite[0][2]?>",
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

function weekDiff(d1, d2) {
	var weeks;
	weeks = (d2.getFullYear() - d1.getFullYear()) * 56;
	weeks -= getWeekNumber(d1);
	weeks += getWeekNumber(d2);
	return weeks <= 0 ? 0 : weeks;
}

function getWeekNumber(d) {
	d = new Date(+d);
	d.setHours(0,0,0);
	d.setDate(d.getDate() + 4 - (d.getDay()||7));
	var yearStart = new Date(d.getFullYear(),0,1);
	var weekNo = Math.ceil(( ( (d - yearStart) / 86400000) + 1)/7);
	return weekNo;
}

$('.completed').on('click', function (e) {
	var id = this.id;
	$.ajax({
		type: 'POST',
		url: './productoFunciones.php',
		data: {funcion: "completed", idprod: id},
		success: function(dtx){
			console.log(dtx);
			window.location.assign("productoView.php");
		},
		error: function (json) {
			console.log(json);

		}
	});
});
</script>
