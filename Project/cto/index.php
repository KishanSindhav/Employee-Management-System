<?php

include "config.php";

session_start();

if($_SESSION['MessageLogIn'] == FALSE)
{
echo "<script>";
echo "alert('CTO, You logged in to system successfully');";
echo "</script>";
$_SESSION['MessageLogIn'] = TRUE;
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
              session_unset();
              header("Location: http://localhost/project/index.php");
        
        }
       
?>

<body class="bg-image">
<nav class="navbar navbar-expand-lg  " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="..\photos\logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
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
          <a class="nav-link text-capitalize" href="view_news.php">Notification</a>
        </li>
        <li class="nav-item">
          
           <?php
          
            $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_cto where `is_cto`= '0' and `read_flag` = '0'");

                        
            $data=mysqli_fetch_assoc($sql);
             
                    if($data['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="view_user.php" >
                            <span>User_details</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="notification dropdown-item" href="view_user.php">User_details</a>
                
            <?php } ?>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="project.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
  <button class="btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
       More Option    
  </button>
  <ul class="dropdown-menu bc " >
    
    <li><a class="dropdown-item" href="pending_user.php">Pending User_details</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="pending_news.php">Pending Notification</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="leave.php">Leave Application</a></li>
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