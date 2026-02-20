<?php

include "config.php";

$i=1;
if(isset($_GET['un'])) {

$user_name = $_GET['un'];
$uid = $_GET['uid'];
$role="";
$u_name=" ";
$u_id="";
$sql = "SELECT * from `user_detail`";
$result=$conn->query($sql);

while($row=$result->fetch_assoc()){
  if($row['user_name']==$user_name){
      $role=$row['role'];
      $u_id=$row['uid'];
  }
  if($row['uid']==$uid){
    $u_name=$row['user_name'];
}
}

}
if(isset($_GET['un'])) {

  $user_name = $_GET['un'];
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

      
      $sql="INSERT INTO `comm_emp_man`(`uid`,`user_name`,`responce`,`time`) values('$uid','$user_name','$responce',now()) ";

      
      $result = $conn->query($sql);

      header("Location: http://localhost/final_project/communicate.php?un=".$user_name."&uid=".$uid);
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
      $sql="INSERT INTO `comm_emp_man`(`uid`,`user_name`,`responce`,`time`) values('$uid','$user_name','$responce',now()) ";
      header("Location: http://localhost/final_project/communicate.php?un=".$user_name."&uid=".$uid);
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
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"manager\\view_user.php?un={$user_name}\">Back</a>";
        }
        else{
            
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"emp\comm_manager.php?un={$user_name}\">Back</a>";
          }
        
    ?>
<h1 ><?php  echo $u_name; ?></h1>
<?php
if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()){

      // if($uid == $row['uid'] && $user_name == $row['user_name'])
      // {

        if($u_id == $row['uid'] && $u_name == $row['user_name']){
?>
            <p><pre id="left"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="left" style="display:none;"><?php echo $row['time'];?></p>
            <br>
<?php
        }
        if($uid == $row['uid'] && $user_name == $row['user_name']){
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

?>
<br><br><br>
<?php $user_name = $_GET['un'];?>
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