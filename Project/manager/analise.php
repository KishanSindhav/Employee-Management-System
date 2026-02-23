<?php

include "config.php";
session_start();
$doneTask = array();
$pendingTask = array();
$arrTotal = array();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <title>Document</title>
    <style>

#bn{
  position: absolute;
  top:10px;
  left:10%;
font-weight: bold;
}
tr:hover {
   color:#009879;
    font-weight: bold;
}
h1{
    text-align:center;
}
button{
    border:none;
    background:none;
}
</style>

</head>

<body style="background-color:aliceblue;">
<br><br><br><br>
<?php
if(isset($_GET['pid']))
{
    $id=$_GET['pid'];

    $totaltask = $conn->query("SELECT COUNT(ntask) from task where pid = $id");

    $total = mysqli_fetch_assoc($totaltask)["COUNT(ntask)"];

    // echo "<br>Total given task : ".$total;

    $totalComTask = $conn->query("SELECT COUNT(ntask) from task where pid = $id and done_flag=1");

    $totalCom = mysqli_fetch_assoc($totalComTask)["COUNT(ntask)"];

    // echo "<br>Total Completed task : ".$totalCom;

    $arrTotal = array(
                        array("label"=> "Pending", "y"=> $total - $totalCom),
                        array("label"=> "Done", "y"=> $totalCom)
                    );


    $totalEmployee = $conn->query("SELECT distinct uid from task where pid = $id");

    if($totalEmployee->num_rows > 0)
    {
        ?>
        <div class="container">
        <table class="table table-striped">
                    <tr class="table-dark">
                        <th>Name</th>
                    
                        <th>Task</th>

                        <th>Pending/Done</th>
                        <th>Number Of Completed Task</th>
                    </tr>
                    <?php
                    $i = 1;
                    $j = 0;

        while($emp = $totalEmployee->fetch_assoc())
        {
            $name = $conn->query("SELECT first_name,last_name from user_detail where uid = '".$emp['uid']."'");
                
?>
                    <tr>
                    <?php
                        $name = $name->fetch_assoc();?>
                        <td><?php echo $name['first_name']." ".$name['last_name'] ?></td>
<?php
                        $task = $conn->query("SELECT ntask,done_flag from task where uid = '".$emp['uid']."'");
                        $fTask = $task->fetch_assoc();?>
                        <td><?php echo $fTask['ntask'] ?> </td>
                        <?php
                            if($fTask['done_flag']==1)
                            {
                                echo "<td>Done</td>";
                            }
                            else{
                                echo "<td>Pending</td>";
                            }
                            $cTask = $conn->query("SELECT COUNT(done_flag) from task where uid = '".$emp['uid']."' AND done_flag=1"); 
                            $pTask = $conn->query("SELECT COUNT(done_flag) from task where uid = '".$emp['uid']."'"); 
                          
                            $cTaskData = mysqli_fetch_assoc($cTask)["COUNT(done_flag)"];
                            $pTaskData = mysqli_fetch_assoc($pTask)["COUNT(done_flag)"];
                           
                            echo "<td>".$cTaskData."  out of ".$pTaskData."</td>";

                            $doneTask[$j] = array("label"=> $name['first_name']." ".$name['last_name'],"y"=> $cTaskData);
                            $pendingTask[$j] = array("label"=> $name['first_name']." ".$name['last_name'],"y"=> $pTaskData);
                            echo "</tr>";
                            $j++;
                        
                    echo "</tr>";


                        while($nextTask = $task->fetch_assoc())
                        {
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td>".$nextTask['ntask']."</td>";
                            if($nextTask['done_flag']==1)
                            {
                                echo "<td>Done</td>";
                            }
                            else{
                                echo "<td>Pending</td>";
                            }
                            echo "<td></td>";
                            echo "</tr>";
                            

                        }
                    
              $i++;  
        } ?>
        </table></div>
        <?php
    }
}
?>
<br><br>


<script>
window.onload = function total() {
 
var chart = new CanvasJS.Chart("chartContainerTotal", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Average Expense Per Day  in Thai Baht"
	},
	subtitles: [{
		text: "Currency Used: Thai Baht (฿)"
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($arrTotal, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>


<script>
window.onload = function () {

    var chartTotal = new CanvasJS.Chart("chartContainerTotal", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Total task report"
	},
	// subtitles: [{
	// 	text: "Currency Used: Thai Baht (฿)"
	// }],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "#,##0",
		dataPoints: <?php echo json_encode($arrTotal, JSON_NUMERIC_CHECK); ?>
	}]
});
chartTotal.render();
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "Chart for completed and pending tasks."
	},
	axisY:{
		includeZero: true
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data: [{
		type: "column",
		name: "Done tasks",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($doneTask, JSON_NUMERIC_CHECK); ?>
	},{
		type: "column",
		name: "Given tasks",
		yValueFormatString: "#0.##",
		showInLegend: true,
		dataPoints: <?php echo json_encode($pendingTask, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}
 
}
</script>
<div class="container">
<div class="row">
<div class="column" id="chartContainerTotal" style="height: 250px; width: 40%; column-gap: 100px;"></div>
<div class="column" id="chartContainer" style="height: 250px; width: 50%; column-gap: 100px;"></div>
</div>
</div>
<a id="bn" class="btn btn-secondary" href="view_project.php">Back</a>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
   
</body>
</html><?php

