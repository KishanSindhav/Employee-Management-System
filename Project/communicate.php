<?php

include "config.php";
session_start();

$i=1;
if(isset($_SESSION['uemail'])){

$user_name =$_SESSION['uemail'];
$uid = $_GET['uid'];
$role="";
$u_name=" ";
$u_id="";
$sql = "SELECT * from `user_detail`";
$result=$conn->query($sql);

while($row=$result->fetch_assoc()){
  if($row['email']==$user_name){
      $role=$row['role'];
      $u_id=$row['uid'];
  }
  if($row['uid']==$uid){
    $f_name=$row['first_name'];
    $l_name=$row['last_name'];
    $u_name=$row['email'];
}
}

}
if(isset($_SESSION['uemail'])) {

  $user_name = $_SESSION['uemail'];
  $uid = $_GET['uid'];
  
  $sql = "SELECT * from `comm_emp_man` ";
  $result = $conn->query($sql);
  
  }

if($role=="1")
{
  $uid=$_GET['uid'];
  if(isset($_POST['submit']))
  {
      $responce = $_POST['subject'];
      if($responce != ''){

      
      $sql="INSERT INTO `comm_emp_man`(`uid`,`email`,`responce`,`time`,`read_flag`) values('$uid','$user_name','$responce',now(),'0')";

      
      $result = $conn->query($sql);

      header("Location: http://localhost/project/communicate.php?uid=".$uid);
      }
      $conn->close();
      
  }
}
else{
  $uid=$_GET['uid'];
  if(isset($_POST['submit']))
  {
    $sql1 = "SELECT * from `user_detail` ";
    $result1 = $conn->query($sql1);
  
    $responce = $_POST['subject'];
      if($responce != ''){
      $sql="INSERT INTO `comm_emp_man`(`uid`,`email`,`responce`,`time`,`read_flag`) values('$uid','$user_name','$responce',now(),'0')";
      header("Location: http://localhost/project/communicate.php?uid=".$uid);
      }
      $result = $conn->query($sql);
      $conn->close();
  }
}






?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
<body  style="background-color: 	#FDF5E6 ;">
<?php 
        if($role=='1')
        {
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"manager\\view_user.php\">Back</a>";
        }
        else{
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"emp\comm_manager.php\">Back</a>";
          }
        
    ?> 
<h1 ><?php  echo $f_name." ".$l_name; ?></h1>
<?php
if ($result->num_rows > 0) {
  // echo $u_id,$u_name;

  $done = $conn->query("UPDATE `comm_emp_man` SET `read_flag`='1' WHERE `uid`= '".$u_id."' and `email` = '".$u_name."' and `read_flag` = '0'");
    
    while ($row = $result->fetch_assoc()){

       


        if($u_id == $row['uid'] && $u_name == $row['email']){
?>
            <p><pre id="left"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="left" style="display:none;"><?php $d=$row['time'];$d1=date("d-m-Y H:i:s",strtotime($d));echo $d1;?></p>
            <br>
<?php
        }
        if($uid == $row['uid'] && $user_name == $row['email']){
            ?>
            <p><pre id="right"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="right" style="display:none;"><?php $d=$row['time'];$d1=date("d-m-Y H:i:s",strtotime($d));echo $d1;?></p>
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

?>
<br><br><br>
<?php $user_name = $_SESSION['uemail'];?>
<form action="" method="post">
<br><br><br>
<table class="table" style="background-color:#FAEBD7;">

  <tbody>
    <div class="responce">
    <tr>
      <td><textarea name="subject"  cols="180" rows="2x"></textarea></td>
      <td><input class="btn btn-info" type="submit" value="Send" name="submit"></input></td>
    </tr>
    </div>
  </tbody>
</table>


 
</form>


</body>
</html>