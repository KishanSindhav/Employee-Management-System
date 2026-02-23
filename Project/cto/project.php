<?php
include "config.php";


$flag = FALSE;

$un;
$sql = "SELECT * from `user_detail`";

$avlEmp = "SELECT * from `avail` where `avail_flag`=0";

$avlMan = "SELECT * from `avail` where `avail_flag`=0";

$result = $conn->query($sql);

$result1 = $conn->query($avlEmp);

$avlManRes = $conn->query($avlMan);




?>

<?php
include "config.php";


  if (isset($_POST['submit'])) {

    $ptitle = $_POST['ptitle'];

    $description = $_POST['desc'];

    $sdate = $_POST['date'];

    $edate = $_POST['edate'];

    $man = $_POST['man'];

    

    $sql = "INSERT INTO `project`(`ptitle`,`description`,`startDate`,`endDate`) 
            values ('$ptitle','$description','$sdate','$edate')";

    $insertP = $conn->query($sql);
    
    $flag = TRUE;
  }
if($flag)
  {
    $getPid = "SELECT * from `project`";
    $getPidRes = $conn->query($getPid);
    $_pid="";
    while($pidRow = $getPidRes->fetch_assoc())
    {
        if($ptitle == $pidRow['ptitle'])
        {
          $_pid = $pidRow['pid'];
        }
          
      
    }

    $result = $conn->query("INSERT into `project_detail`(`pid`,`uid`) values('$_pid','$man')");
    $avlSetMan1 = $conn->query("UPDATE `avail` SET `avail_flag`=1,`pid`=$_pid WHERE `uid`=$man");

if(!empty($_POST['emp'])) {

  foreach($_POST['emp'] as $value){
    $result = $conn->query("INSERT into `project_detail`(`pid`,`uid`) values('$_pid','$value')");
    $avlSet1 = $conn->query("UPDATE `avail` SET `avail_flag`=1,`pid`=$_pid WHERE `uid`=$value");
  }
  header("Location: project.php");
}

   

    

    if ($result == TRUE) {

      // alert('Your feedback is given')";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    // $conn->close(); 

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
  * {    
    box-sizing: border-box;    
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
          <a class="nav-link active text-capitalize" href="project.php">Project</a>
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
<br><br>
<h2>Enter Project Details</h2>  
  <br>
<div class="container">  
    <form method="POST">    
      <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;">Project Title</label>    
        </div>    
        <div class="col-75">    
          <input type="text"  name="ptitle" placeholder="Project title.." required>    
        </div>    
      </div>    
        
      <div class="row">    
        <div class="col-25">    
          <label for="feed_back" style=" font-weight: bold;">Project Description</label>    
        </div>    
        <div class="col-75">    
          <textarea  name="desc" placeholder="Write project description.." style="height:200px" required></textarea>    
        </div>    
      </div>
      
      <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;">Starting Date</label>    
        </div>    
        <div class="col-75">    
          <input type="date"  name="date" id="startDate" placeholder="Starting date of project.." required>    
        </div>    
      </div>

      <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;">Ending Date</label>    
        </div>    
        <div class="col-75">    
          <input type="date"  name="edate" id="endDate" placeholder="Ending date of project.." required>    
        </div>    
      </div>

      <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;">Available Manager</label>    
        </div>    
          
      </div>

      <?php
      
    if ($avlManRes->num_rows > 0) {
        while ($row = $avlManRes->fetch_assoc() ){
          
          $user = "SELECT * from `user_detail`";
          $manun = $conn->query($user);
          if(!$manun)
          {
            echo 'manun';
          }
          $u_id='';
          $un='';
          if($manun->num_rows > 0){
            
          while ($row1 = $manun->fetch_assoc() ){
            
            if($row1['uid']==$row['uid'] && $row1['role']==1)
            {
              
              $u_id=$row['uid'];
              $fn = $row1['first_name'];
              $ln = $row1['last_name'];
            }
          }
        }
          if(!empty($u_id)){
      ?>  
      
      <div class="row">
        <div class="me">
        <label><?php echo $fn.' '.$ln;?></label>  
        <?php 
        
        if($u_id==$row['uid']){ ?>
        <input type="radio" name="man" id="" value="<?php echo $row['uid']?>" required></input>
        </div>    
      </div>
          
      

          <?php  
        }
        } 
    }
  }
  else{
    echo "<p><pre>NO MANAGER AVAILABLE </pre></p>";
  }
/////////////////////////////////////////////////////////////////////
?> 

      <div class="row">    
        <div class="col-25">    
          <label for="fname" style=" font-weight: bold;">Available Employee</label>    
        </div>    
          
      </div>

      <?php
      
    if ($result1->num_rows > 0) {
        while ($row = $result1->fetch_assoc() ){
          $user = "SELECT * from `user_detail`";
          $empun = $conn->query($user);
          $euid='';
          $eun='';
          if ($empun->num_rows > 0) {
          while ($row1 = $empun->fetch_assoc() ){

            if($row1['uid']==$row['uid'] && $row1['role']==2)
            {
              $euid=$row1['uid'];
              $efn = $row1['first_name'];
              $eln = $row1['last_name'];
            }
          }
        }
          if(!empty($euid)){
      ?>  
      
      <div class="row">
        <div class="me">

        <label><?php echo $efn.' '.$eln;?></label> 
        <?php 
        if($euid==$row['uid']){ 
          ?> 

        <input type="checkbox" name="emp[]" id="" value="<?php echo $row['uid']?>" ></input>
        </div>    
      </div>
          
      

          <?php   
        }
        }
    }
  }
  else{
    echo "<p><pre>NO EMPLOYEE AVAILABLE </pre></p>";
  }
?> 

      <div class="row">   
         <a href="view_project.php"><input type="button" class="btn btn-secondary" value="View" name="View">  </a><br><br>
         
        </div>  

        <input type="submit" class="bs btn btn-secondary  " value="Submit" name="submit"> 
    </form>  

    <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementById("startDate").setAttribute("min", today);
    document.getElementById("endDate").setAttribute("min", today);
    document.getElementById("startDate").addEventListener("change", function() {
        document.getElementById("endDate").setAttribute("min", this.value);
    });
</script>  
  </div>  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 

</body>
<!-- <input name="favorites[]" type="text"> -->
</html>
<?php $conn->close();?>
