<?php 

include "config.php";
session_start();

$sql = "SELECT * FROM notification order by `time` desc";

$result = $conn->query($sql);


if(isset($_SESSION['uemail']))
{
  $email = $_SESSION['uemail'];

  $sql = $conn->query("SELECT * from user_detail where email = '".$email."'");
  $data = $sql->fetch_assoc();
  $uid = $data['uid'];
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


    <style>
      .bc,nav{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }
 .notification {

  color: black;
  text-decoration: none;
  padding: 7px 10px;
  position: relative;
  display: inline-block;
  border-radius: 2px;
}

.notification .badge {
  position: absolute;
  top: -10px;
  right: -10px;
  padding: 5px 10px;
  border-radius: 50%;
  background: grey;
  color: black;
}
#ti{
    font-size:25px;
    background-color:lightblue;
}
    </style>




</head>
<body style="background-color: 	aliceblue ;">
<nav class="navbar navbar-expand-lg  " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../photos/logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
      HR INDUSTRY
    </a>
  </div>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-1">
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-capitalize" href="p2.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="view_project.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
         <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_emp_man where `uid` = '".$uid."'and `read_flag` = '0'");
                    $data=mysqli_fetch_assoc($sql);
                     
                    if($data['msg'] > 0)
                    {
                    
                ?>
                        <td>
                        <button class="notification btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>  More Option  </span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                            </button></td>
                     </tr>   
            <?php  

                    }else{

            ?>
                <button class="btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                 More Option                           
                </button>
                
            <?php } ?>
  <ul class="dropdown-menu bc " >
    
    <li><a class="dropdown-item" href="user_detail.php">Your Details</a></li>
    <li><hr class="dropdown-divider"></li>
    <li> <?php
                        
       
                        
                    if($data['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="comm_manager.php" >
                            <span>Communicate</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="comm_manager.php">Communicate</a>
                
            <?php } ?></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="leave.php">Leave</a></li>
    
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>
<br><br><br><br>
<div class="container">
    <?php
    if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

    ?>

        
        <table class="table table-striped">
            <tr>
                <th id=ti><pre><p><?php echo $row['title'] ?></p></pre></th>
            </tr>    
            <tr>
                <td><p><?php echo $row['content'] ?></p></td>
            </tr>  
            <tr>
                <td><pre><p><?php $d=$row['time'];$d1=date("d-m-Y H:i:s",strtotime($d));echo $d1;?></p></pre></td>
            </tr>     

        </table>
        
   <?php
        }
    }
    
    ?>
    </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
     
</body>
</html>