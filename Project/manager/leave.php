<?php

include 'config.php';
include '..\pdo.php';

session_start();

$uid = $_SESSION['uid'];

$dataL = $connPDO->prepare("SELECT * from `emp_leave` where `uid` = :uid ");
$dataL->bindParam(':uid',$uid);
$dataL->execute();

if(isset($_POST['submit']))
{ 
    $id = $_POST['tid'];
    $file = $_FILES['fileDoc'];


    if (!empty($file) && isset($file)) {
    
        $allowedTypes = ['image/jpeg','image/jpg', 'image/png', 'application/pdf'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Only JPEG, PNG, GIF, and PDF files are allowed.";
            exit();
        }
    
        $fileName = $id.'_'.$uid.'_'.$file['name'];
        $uploadsDir = '../leave_doc/';
        if (!move_uploaded_file($file['tmp_name'], $uploadsDir.$fileName)) {
            echo "There was an error uploading the file.";
            exit();
        }
        $updateData = $conn->query("UPDATE `emp_leave` set `path` = '".$fileName."' where `id`= '".$id."'" );
        header('Location: leave.php');
        }
     
    
    }
   
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"> 
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>-->

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
</style>
</head>
<body style="background-color: aliceblue ;">
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
          <a class="nav-link active text-capitalize" href="leave.php">Leave</a>
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
<center><h2>Click For New Leave <button class="btn-btn-secondary" onclick="window.location.href='..\\leave_form.php'";>leave</button></h2></center>
<div class="container">
<table class="table table-striped" >
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Reason</th>
            <th>Start date</th>
            <th>End date</th>
            <th>Status</th>
            <th>Document</th>
        </tr>
        
    <?php
        
            while($row = $dataL->fetch(PDO::FETCH_ASSOC))
            {
                ?>
            <tr>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['uid']?></td>
                <td><?php echo $row['reason']?></td>
                <td><?php echo $row['sdate']?></td>
                <td><?php echo $row['edate']?></td>
                <td>
<?php
if($row['status'] == 0){
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($row['status'] == 1){
    echo "<span class='badge bg-success'>Approved</span>";
}
elseif($row['status'] == 2){
    echo "<span class='badge bg-danger'>Rejected</span>";
}
else{
    echo "<span class='badge bg-secondary'>Unknown</span>";
}
?>
</td>
                <?php
                if($row['path'] == NULL)
                {
                ?>
                <form method="post" enctype="multipart/form-data">
                <td>
                <input type="file"  name="fileDoc"  id="formFile">
                <input type="hidden" id="tid" name="tid" value="<?php echo $row['id'] ?>">
                
                <input type="submit" name="submit" value="Submit">

                </td>
                
                </form>
                <?php
                }
                else{
                ?>
                <td><a href="../leave_doc/<?php echo $row['path'] ?>"><?php echo $row['path'] ?></a></td>
               <?php } ?>
            </tr>

                <?php
            }
        
    ?>
    </table>
    </div>
</body>
</html>