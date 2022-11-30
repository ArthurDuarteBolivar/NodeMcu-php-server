<!DOCTYPE html>
<html>
<head>
<?php 
include("conexaonova.php");
  $sql = "SELECT * FROM thdados";
 $con =  $mysqli->query($sql);
?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Top Oil Reserves"
	},
	axisY: {
		title: "Reserves(MMbbl)"
	},
	data: [{        
		type: "column",  
		showInLegend: true, 
		legendMarkerColor: "grey",
		legendText: "MMbbl = one million barrels",
		dataPoints:[ 
			<?php while($dado = $con->fetch_array()){
				echo "{label:" .$dado['data'] . ",y:" . $dado['count_button'] . "},";
			 } ?>]
	}]
});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>
<body>
</body>
</html>