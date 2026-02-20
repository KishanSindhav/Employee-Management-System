<?php

include "config.php";
$i=0;

if(isset($_POST['submit']))
{
    $man = $_POST['man'];
    $emp = $_POST['emp'];
    
    $sql = "SELECT * from `comm_emp_man`";
    // $sql1 = "SELECT * from `user_detail` where `user_name` = $man";
    // $sql2 = "SELECT * from `user_detail` where `user_name` = $emp";

    $result = $conn->query($sql);
    // print_r($result); 
    $result1 = $conn->query("SELECT * from `user_detail`");
    

    if($result1)
    {
        while ($row1 = $result1->fetch_assoc()){
            if($man == $row1['user_name'])
            {
                $manuid = $row1['uid'];
                // echo $manuid;
            }
            if($emp == $row1['user_name'])
            {
                $empuid = $row1['uid'];
                // echo $empuid;
            }
        
        }

    }
    

}

?>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Document</title>
    <style>
      #left{
        left:10px;
        position:absolute;
      }
  
      #right{
        position:absolute;
        right:10px;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <style>
      #un{
       text-align:center;
      }
      /* table,th,tr,td
      {
        border:2px Solid black;
        border-collapse:collapse;
        text-align:center;
      } */
      table{
        position:fixed;
        top:92%;
        background-color: silver;
        border:1px Solid black;
      }
      table,th,tr,td{
        border:1px Solid black;
      }
      .responce{
       
      }
      h1{
            
            background-color: rgba(0, 0, 0, 0.1);
            border: 1px solid black;
            text-align:center;

      }
      button{
        border:none;
      }
            
#bn{
  position: fixed;
  top:24px;
  left:1%;
  
}
    </style>
</head>
<body style="background-color: 	#FDF5E6 ;">

<?php
if($result){
echo "<h1>Communication between ".$man." and ".$emp."</h1>";
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()){

      

        if($empuid == $row['uid'] && $man == $row['user_name']){
          
?>
            <p><pre id="left"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="left" style="display:none;"><?php echo $row['time'];?></p>
            <br>
<?php
        }
        if($manuid == $row['uid'] && $emp == $row['user_name']){
            
            ?>
            <p><pre id="right"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="right" style="display:none;"><?php echo $row['time'];?></p>
            <br>
            <?php
        // }
    }
    ?>
    <script>
        $(document).ready(function(){
        $(".b<?php echo$i; ?>").hover(function(){
            $(".re<?php echo$i; ?>").toggle();
        });
        });

    </script>
    <?php $i++;
  }
}
}
?>
<a id="bn" class="btn btn-info" href="view_user.php?un=CTO2023">Back</a>
</body>
</html>