<?php


include "config.php";
include "../pdo.php";

session_start();


if(isset($_SESSION['uemail'])) {

    $user_name = $_SESSION['uemail']; 

    $sql = "SELECT * FROM `user_detail` WHERE `email`='$user_name'";

    

    $result = $conn->query($sql); 

   
if(isset($_SESSION['uemail']))
{
  $email = $_SESSION['uemail'];

  $sql = $conn->query("SELECT * from user_detail where email = '".$email."'");
  $data = $sql->fetch_assoc();
  $uid = $data['uid'];
}

if(isset($_POST['submit']))
{ 
    $uid = $_POST['uid'];
    $file = $_FILES['fileDoc'];


    if (!empty($file) && isset($file)) {
    
        $allowedTypes = ['image/jpeg','image/jpg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Only JPEG, and PNG are allowed.";
            exit();
        }
    
        $fileName = $uid.'_profile.jpg';
        $uploadsDir = '../profilePhoto/';
        if (!move_uploaded_file($file['tmp_name'], $uploadsDir.$fileName)) {
            echo "There was an error uploading the file.";
            exit();
        }
        $updateData = $conn->query("UPDATE `user_detail` set `pPAth` = '".$fileName."' where `uid`= '".$uid."'" );
        header('Location: user_detail.php');
        }
     
    
    }
    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>

tr:hover {
   color:#009879;
    font-weight: bold;
}
#b{
font-weight: bold;      
}
.bc,nav{
  background-color:lightyellow;
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

#profileImg{
  border: 1px solid #ddd;
  border-radius: 50%;
  padding: 5px;
  width: 200px;
  height: 200px;
}
#profileImg:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
#photo{
  background-color : none;
}
#photo{ background-color:transparent; }
</style>
</head>
<body style="background-color:aliceblue;">
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
          <a class="nav-link text-capitalize" href="news.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="view_project.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="leave.php">Leave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
        <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_emp_man where `uid` = '".$uid."'  and `read_flag` = '0'");
                        $sql1 = $conn->query("SELECT COUNT(read_flag) as msg from comm_cto where `uid` = '".$uid."' and `is_cto`= '1' and `read_flag` = '0'");

                        
                        $data=mysqli_fetch_assoc($sql);
                        $data1=mysqli_fetch_assoc($sql1);
                        
                    if($data['msg'] > 0 || $data1['msg'] >0)
                    {
                      $totalmsg = (int)$data['msg'] + (int)$data1['msg'];
                ?>
                        <td>
                        <button class="notification btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>  More Option  </span>
                            <span class="badge"><?php echo $totalmsg ?></span>
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
                        <a  class="dropdown-item notification" href="view_user.php" >
                            <span>Employee Details</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="view_user.php">Employee Details</a>
                
            <?php } ?></li>
    <li><hr class="dropdown-divider"></li>
    <li> <?php
                        
                       
                        
                    if($data1['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="http://localhost/project/communicate_cto.php?me_un=manager" >
                            <span>CTO Messages</span>
                            <span class="badge"><?php echo $data1['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="http://localhost/project/communicate_cto.php?me_un=manager">CTO Messages</a>
                
            <?php } ?></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>

  <?php 
  
    if($result -> num_rows > 0 ){

        while($row = $result -> fetch_assoc()  ){
  
  ?>
<div class="container">
    <table class="table table-striped" >
  <center><h1>User Details</h1></center>
  <br><br>
  <thead>
   
  </thead>
  <tbody>
    <?php if($row['pPAth']!=NULL){ ?>
    <tr>
      <td scope="row" id="photo" colspan="2">
          <center><img src="../profilePhoto/<?php echo $row['pPAth']?>" id="profileImg" alt="profile photo"></center>
      </td>
    </tr>
    <?php }else{ ?>
    <tr>
      <form method="post" enctype="multipart/form-data">
                <td colspan="2" style="textalign:centre">
                <input type="file"  name="fileDoc"  id="formFile">
                <input type="hidden" id="uid" name="uid" value="<?php echo $row['uid'] ?>">
                
                <input type="submit" name="submit" value="Submit">

                </td>
                </form>
    </tr>
    <?php } ?>
    <tr>
            <th scope="row">ID</th>
            <td><?php echo $row['uid'] ?></td>
    </tr>

    <tr>
            <th scope="row">First Name</th>
            <td><?php echo $row['first_name'] ?></td>
    </tr>
    <tr>
            <th scope="row">Last Name</th>
            <td><?php echo $row['last_name'] ?></td>
    </tr>
    <tr>
            <th scope="row">E-mail</th>
            <td><?php echo $row['email'] ?></td>
    </tr>
    <tr>
            <th scope="row">Address</th>
            <td><?php echo $row['address'] ?></td>
    </tr>

   
  </tbody>
</table>
</div>
<br>
<a id="b" class=" btn btn-secondary" href="update_user.php">Update</a> 


                   
<?php 
        } 
    }
 ?>  


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
                
</body>
</html>