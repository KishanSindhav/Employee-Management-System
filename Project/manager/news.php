<?php
include "config.php";

session_start();


$uid;
$sql = "SELECT * from `user_detail`";

$result = $conn->query($sql);

if ($result->num_rows > 0) {        
  
  while ($row = $result->fetch_assoc()) {

    if($_SESSION['uemail']==$row['email']){

      $uid = $row['uid'];
    }
  } 

}

?>
<?php 

include "config.php";

  if (isset($_POST['submit'])) {

    $title = $_POST['title'];

    $content = $_POST['content'];

    $sql = "INSERT INTO `temp_notification`(`uid`,`title`, `content`, `time`) 
            VALUES ('$uid','$title','$content',now())";

    $result = $conn->query($sql);

    if ($result == TRUE) {

      // alert('Your feedback is given')";
      //header("Location : news.php");

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    

  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
   <title>Notification</title>

    <style>  
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
.bc,nav{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }

input[type=text], select, textarea {    
    width: 100%;    
    padding: 12px;    
    border: 1px solid rgb(70, 68, 68);    
    border-radius: 4px;    
    resize: vertical;    
  }     
 input[type=email], select, textarea {    
    width: 100%;    
    padding: 12px;    
    border: 1px solid rgb(70, 68, 68);    
    border-radius: 4px;    
    resize: vertical;    
  }    
        
  label {    
    padding: 12px 12px 12px 0;    
    display: inline-block;    
   
  }    
     
   
       
  input[type=submit]:hover {    
    background-color: #45a049;    
  }    
      
  .col-25 {    
    float: left;    
    width: 25%;    
    margin-top: 6px;    
  }    
      
  .col-75 {    
    float: left;    
    width: 75%;    
    margin-top: 6px;    
  }  
  .me {    
   padding:0px 100px;
      
    margin-top: 6px;  
  }  
      
  /* Clear floats after the columns */    
  .row:after {    
    content: "";    
    display: table;    
    clear: both;    
  }   
  
  .fa:hover {
    opacity: 0.7;
}
.bs{   
  position: relative;
    margin: 0vh 12vh;
    top: -5vh;
}
h2{
  text-align:center;
  font-size:30px;
} 

</style>
</head>
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
          <a class="nav-link active text-capitalize" href="news.php">Notification</a>
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

                        if($sql)
                        $data=mysqli_fetch_assoc($sql);
                      if($sql1)
                        $data1=mysqli_fetch_assoc($sql1);
                    if($sql)
                    if($sql1)   
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

<body  style="background-color: aliceblue ;">
  
<h2>Enter Notifications</h2>  
  <br>
<div class="container">  
    <form method="POST">  
    <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;"> Title</label>    
        </div>    
        <div class="col-75">    
          <input type="text"  name="title" placeholder="News title.." required>    
        </div>    
      </div>    
        
      <div class="row">    
        <div class="col-25">    
          <label for="feed_back" style=" font-weight: bold;">Content</label>    
        </div>    
        <div class="col-75">    
          <textarea  name="content" placeholder="Write Notification Content.." style="height:200px" required></textarea>    
        </div>    
      </div>    
      <div class="row">   
         <a href="view_news.php"><input class="btn btn-secondary" type="button" value="View" name="View">  </a>
         </div>
        <input type="submit" class="bs btn btn-secondary  " value="Submit" name="submit">  
        <!-- <a class="btn btn-info" href="view.php">view</a>   -->
        
    </form>    
  </div>  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
</body>
</html>
<?php $conn->close(); ?>