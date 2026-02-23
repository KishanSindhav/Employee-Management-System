<?php

include "config.php";

session_start();

if($_SESSION['MessageLogIn'] == FALSE)
{
echo "<script>";
echo "alert('You logged in to system successfully');";
echo "</script>";
$_SESSION['MessageLogIn'] = TRUE;

}

if(isset($_SESSION['uemail']))
{
  $email = $_SESSION['uemail'];
  $sql = $conn->query("SELECT * from user_detail where email = '".$email."'");
  $data = $sql->fetch_assoc();
  $uid = $data['uid'];
}

function getTimeDiffWithDateTime($time1, $time2) {
  $dateTime1 = new DateTime($time1);
  $dateTime2 = new DateTime($time2);
 
  // Calculate the difference between the two DateTime objects.
  $diff = $dateTime1->diff($dateTime2);

  // Convert the difference in seconds to a human-readable format.
  $timeDiff = $diff->format('%H:%i:%s');

  return $diff;
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
 .bg-image{
   background-image: url('../photos/bgpic.jpg');
   background-repeat: no-repeat;
   background-attachment: fixed;
   background-size: 100% 100%;
 }
 h1{
  color:white;
  position:relative;
  background-color: rgba(0, 0, 0, 0.7);
 border: 3px solid #f1f1f1;
left: 50%;
top:270px;
transform: translate(-50%, -50%);
 z-index: 5;
 }
 .emp{
  position:relative;
  top:400px;
  color:white;    
 }
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
    </style>
</head>

<?php
        if(isset($_POST['btn']))
        {
              $sql = $conn->query("UPDATE `tempcount`
              SET `lOutTime` = NOW()
              WHERE `uid` = '".$uid."'
              ORDER BY `id` DESC
              LIMIT 1
              ");

              $sql = $conn->query("SELECT lTime,lOutTime from tempcount where `uid` = '".$uid."' order by id desc limit 1");
              $row1 = $sql->fetch_assoc();

              $time1 = $row1['lTime'];
              $time2 = $row1['lOutTime'];

              $timeDiff = getTimeDiffWithDateTime($time1, $time2);

              $hour = $timeDiff->format('%H');
              $minute = $timeDiff->format('%i');


              $temp = (float)$hour;

              if($minute >= 30)
              {
                $temp = $temp + 0.5;
              }

              $date = date('Y-m-d');
              $work = $conn->query("SELECT workHour from attendance where `uid` = '".$uid."' and  `date` = '".$date."'");

              $tempRow = $work->fetch_assoc();

              $tempWork = $tempRow['workHour'];

              $tempWork += $temp;

              $sql1 = $conn->query("UPDATE `attendance`
              SET `workHour` = '".$tempWork."'
              WHERE `uid` = '".$uid."'
              AND `date` = '".$date."'
              ");

              session_unset();
              header("Location: http://localhost/project/index.php");
        
        }
?>

<body class="bg-image">
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p2.php">Notification</a>
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

<section class="bg-main bg-color">
<div class="container">
  <div class="row">
    <div class="text-center">
    <h1>Employee Management</h1>
    <div class="emp">
    <h3>Effortlessly manage your  employee data</h3>
    <p>Manage your  workforce with a flexible,
      employee database management system. <br>
      Build a secure,
      comprehensive, and scalable database to get a better understanding of your workforce.</p>
      
      <div class="text-center">
        <form action="" method="post">
      LogOut account ! <input type="submit" name="btn" value="Log Out"  class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="For LogOut" ></input>
      </form>  
    </div>
      </div>
      </div>
    </div>
  </div>
</div>

</section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
      <script>
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
</script>
    </body>

</html>



