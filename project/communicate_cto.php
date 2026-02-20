<?php

include "config.php";

$i=1;
$me = $_GET['me_un'];
if(isset($_GET['me_un'])) {
  
  $me = $_GET['me_un'];
  if($me=='CTO2023')
  {
    $uid = $_GET['uid'];

    $sql = "SELECT * from `user_detail`";
    $result=$conn->query($sql);
    $un='';
    while($row=$result->fetch_assoc()){
      if($row['uid']==$uid){
          $un=$row['user_name'];
      }
    }
    
      $sql = "SELECT * from `comm_cto` where `uid`=$uid";
      $result = $conn->query($sql);  

  }else{
    $user_name=$_GET['un'];
    $sql = "SELECT * from `user_detail`";
    $result=$conn->query($sql);
    $uid='';
    while($row=$result->fetch_assoc()){
      if($row['user_name']==$user_name){
          $uid=$row['uid'];
      }
    }
    
      $sql = "SELECT * from `comm_cto` where `uid`=$uid";
      $result = $conn->query($sql);
    }


}

if($me=='CTO2023')
{
  $uid=$_GET['uid'];
  if(isset($_POST['submit']))
  {
      $responce = $_POST['subject'];
      if($responce != ''){

      
        $sql="INSERT INTO `comm_cto`(`uid`,`responce`,`time`,`is_cto`) values('$uid','$responce',now(),1)";

      
      $result = $conn->query($sql);

      header("Location: http://localhost/final_project/communicate_cto.php?me_un=CTO2023&uid=".$uid);
      }
      $conn->close();
      
  }
}
else
{
  $user_name=$_GET['un'];
  
  if(isset($_POST['submit']))
  {
    $uid='';
    $sql = "SELECT * from user_detail";
    $result = $conn->query($sql);
    while($row=$result->fetch_assoc()){
      if($row['user_name']==$user_name){
          $uid=$row['uid'];
      }
    }
    
      $sql = "SELECT * from `comm_cto` where `uid`=$uid";
      $result = $conn->query($sql);
      $responce = $_POST['subject'];
      if($responce != ''){

      
        $sql="INSERT INTO `comm_cto`(`uid`,`responce`,`time`,`is_cto`) values('$uid','$responce',now(),0)";

      
      $result = $conn->query($sql);

      header("Location: http://localhost/final_project/communicate_cto.php?me_un=CTO&un=".$user_name);
      }
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
<body style="background-color: 	#FDF5E6 ;">
    <?php 
        if($me=='CTO')
        {
            echo "<h1>CTO</h1>";
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"manager\index.php?un={$user_name}\">Back</a>";
        }
        else{
            echo"<h1>".$un."</h1>";
            echo"<a id=\"bn\" class=\"btn btn-info\" href=\"cto\\view_user.php?un=CTO2023\">Back</a>";
          }
        
    ?>
<?php
if($me=='CTO2023')
{
  if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()){

        if($row['uid']==$uid){

        if($row['is_cto']==0 ){
?>
            <p><pre id="left"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="left" style="display:none;"><?php echo $row['time'];?></p>
            <br>
<?php
        }
        else{
            ?>
            <p><pre id="right"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="right" style="display:none;"><?php echo $row['time'];?></p>
            <br>
            <?php
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
}
else
{
  if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()){

        if($row['uid']==$uid){

        if($row['is_cto']==1){
?>
            <p><pre id="left"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="left" style="display:none;"><?php echo $row['time'];?></p>
            <br>
<?php
        }
        else{
            ?>
            <p><pre id="right"><button class="b<?php echo$i; ?>"><?php echo $row['responce'];?></button></pre></p><br><br>
            <p class="re<?php echo$i; ?>" id="right" style="display:none;"><?php echo $row['time'];?></p>
            <br>
            <?php
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
}

?>

<form action="" method="post">
<br><br><br>
<table class="table" style="background-color:#FAEBD7;">

  <tbody>
    <div class="responce">
    <tr>
      <td><textarea name="subject"  cols="180" rows="2x"></textarea></td>
      <td><input  class="btn btn-info" type="submit" value="Send" name="submit"></input></td>
    </tr>
    </div>
  </tbody>
</table>

</form>
</body>
</html>

<!-- manager = http://localhost/final_project/communicate_cto.php?me_un=CTO&un=manager1 -->

<!-- http://localhost/final_project/communicate_cto.php?me_un=CTO2023&uid=1 -->

<!-- create table comm_cto(
id int(4) auto_increment primary key,
uid int(3) not null,
responce varchar(2000) not null,
time timestamp,
read_flag int(1),
is_cto int(1),
foreign key (uid) references user_detail(uid)
); -->