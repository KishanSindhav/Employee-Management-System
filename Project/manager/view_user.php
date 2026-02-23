<?php

include "config.php";

session_start();

if(isset($_SESSION['uemail']))
{
  $email = $_SESSION['uemail'];

  $sql = $conn->query("SELECT * from user_detail where email = '".$email."'");
  $data = $sql->fetch_assoc();
  $uid = $data['uid'];
}


$uid = "";

if(isset($_SESSION['uemail'])) {

$user_name = $_SESSION['uemail'];

$sql = "SELECT * FROM user_detail where `email`= '".$user_name."'";

$result = $conn->query($sql);

$row = $result->fetch_assoc();

$uid = $row['uid'];

}

?>
<?php 

include "config.php";

$sql = "SELECT * FROM user_detail where `role`=2";

$result = $conn->query($sql);

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>
<style>
      .bc,nav{
  background-color:lightyellow;
 }
tr:hover {
   color:#009879;
    font-weight: bold;
}
h2{
    text-align:center;
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

.noti{
position: relative;
}
.noti .ba {
position: absolute;
top: -10px;
right: -10px;
padding: 5px 10px;
border-radius: 50%;
background: grey;
color: black;
}
</style>
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
<br><br>
    <div class="container">

        <h2>Employees</h2>
<br>

<table  class="table table-striped" >

    <thead>

        <tr class="table-dark">

        <th>Employee ID</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Email</th>

        <th>Address</th>

        <th>Communicate</th>

    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['uid']; ?></td>

                    <td><?php echo $row['first_name']; ?></td>

                    <td><?php echo $row['last_name']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['address']; ?></td>

                    <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_emp_man where `uid` = '".$uid."' and `email`= '".$row['email']."' and `read_flag` = '0'");

                        
                        $data=mysqli_fetch_assoc($sql);
                        
                    if($data['msg'] > 0)
                    {
                        ?>
                        <td>
                        <a class="btn btn-secondary noti"   href="http://localhost/project/communicate.php?uid=<?php echo $row['uid']; ?>" >
                            <span>Communicate</span>
                            <span class="ba"><?php echo $data['msg'] ?></span>
                        </a>
                         <!-- <a class="btn btn-info" href="http://localhost/project/communicate.php?uid=<?php echo $row['uid']; ?>">Communicate</a></td> -->
                    </tr>   
                    <?php  

                    }else{

                    ?>
                    
                    <td> <a class="btn btn-secondary" href="http://localhost/project/communicate.php?uid=<?php echo $row['uid']; ?>">Communicate</a></td>
                    </tr>                       

        <?php     
                    }

                }

            }

        ?>                

    </tbody>

</table>

    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
      
 

</body>

</html>
