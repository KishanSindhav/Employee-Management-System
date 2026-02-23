<?php

include "config.php";


    if(isset($_GET['uid']))
    {
        $uid = $_GET['uid'];
        $attendance = array();
        $j=0;


		if(!isset($_POST['submit']))
		{
			$m = date('m');
			
			$y = date('Y');
			

			$sql = $conn->query("SELECT *
			FROM attendance
			WHERE MONTH(date) = '".$m."'
			AND YEAR(date) = '".$y."'
			AND `uid` = '".$uid."'
			");
			
			if($sql->num_rows > 0){
				while($row = $sql->fetch_assoc())
				{
					$attendance[$j] = array("label"=> $row['date'],"y"=> $row['workHour']);
					$j++;
				}
			}
		}
		else{

			//$m = $_POST['month'];
			$y = date('Y');

			$sDate = $_POST['startDate'];
			$eDate = $_POST['endDate'];

			// $sql = $conn->query("SELECT *
			// FROM attendance
			// WHERE MONTH(date) = '".$m."'
			// AND YEAR(date) = '".$y."'
			// AND `uid` = '".$uid."'
			// ");

			$sql = $conn->query("SELECT *
			FROM attendance
			WHERE `date` >= '".$sDate."'
			AND `date` <= '".$eDate."'
			AND `uid` = '".$uid."'
			");
			
			if($sql->num_rows > 0){
				while($row = $sql->fetch_assoc())
				{
					$attendance[$j] = array("label"=> $row['date'],"y"=> $row['workHour']);
					$j++;
				}
			
		}

	}
        

        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
<style>
#bn{
  position: absolute;
  top:10px;
  left:10%;
font-weight: bold;
}
</style>
	<script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "Attendance"
	},
	axisY:{
		title: "Work Hour",
		includeZero: true
	},
	axisX:{
		title: "Date"
	},
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
		indexLabelPlacement: "outside",   
		dataPoints: <?php echo json_encode($attendance, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("sdate").setAttribute("max", today);
</script>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("edate").setAttribute("max", today);
</script>

<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<body style="background-color: aliceblue;">
<br><br>
<a id="bn" class="btn btn-secondary " href="cto\view_user.php">Back</a>
<br><br><br>

<div class="container">
<div id="chartContainer" style="height: 370px; width: 100%;"></div></div>
<br><br><br>
<div class="container">
<form action="" method="POST">
<h4><b><label for="exampleDataList" class="form-label">Select Starting and Ending date</label></b></h4>
<!-- 
<select name="month" class="form-select form-select-lg mb-3" aria-label=".form-select-sm example">
	<option value="1" >JANUARY</option>
	<option value="2">FEBRUARY</option>
	<option value="3">MARCH</option>
	<option value="4">APRIL</option>
	<option value="5">MAY</option>
	<option value="6">JUNE</option>
	<option value="7">JULY</option>
	<option value="8">AUGUST</option>
	<option value="9">SEPTEMBER</option>
	<option value="10">OCTOBER</option>
	<option value="11">NOVEMBER</option>
	<option value="12">DECEMBER</option>
</select> -->

<input type="date" id="startDate" name="startDate" max="">
<input type="date" id="endDate" name="endDate" min="" max="">

<input class="btn btn-secondary" type="submit" name="submit" value="Submit">
</form>

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("startDate").setAttribute("max", today);
    document.getElementById("endDate").setAttribute("max", today);
    document.getElementById("startDate").addEventListener("change", function() {
        document.getElementById("endDate").setAttribute("min", this.value);
    });
</script>

</div>
</body>
</html>

