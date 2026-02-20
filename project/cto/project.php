<?php
include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}
$flag = FALSE;
$uid='';
$un;
$sql = "SELECT * from `user_detail`";

$avlEmp = "SELECT * from `avail` where `avail_flag`=0";

$avlMan = "SELECT * from `avail` where `avail_flag`=0";

$result = $conn->query($sql);

$result1 = $conn->query($avlEmp);

$avlManRes = $conn->query($avlMan);



if ($result->num_rows > 0) {        
  
  while ($row = $result->fetch_assoc()) {

    if($user_name==$row['user_name']){

      $uid = $row['uid'];
    }
  } 

}
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
    $avlSetMan1 = $conn->query("UPDATE `avail` SET `avail_flag`=1 WHERE `uid`=$man");

if(!empty($_POST['emp'])) {

  foreach($_POST['emp'] as $value){
    $result = $conn->query("INSERT into `project_detail`(`pid`,`uid`) values('$_pid','$value')");
    $avlSet1 = $conn->query("UPDATE `avail` SET `avail_flag`=1 WHERE `uid`=$value");
  }
  header("Location: project.php?un=CTO2023");
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <title>Notification</title>

    <style>    
  * {    
    box-sizing: border-box;    
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
      
  input[type=submit] {    
    background-color: rgb(37, 116, 161);    
    color: white;    
    padding: 12px 20px;    
    border: none;    
    border-radius: 4px;    
    cursor: pointer;    
    float: right;    
  }    
      
  input[type=submit]:hover {    
    background-color: #45a049;    
  }    
      
  .container {    
    border-radius: 5px;    
    background-color: #f2f2f2;    
    padding: 20px;    
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
      
  /* Clear floats after the columns */    
  .row:after {    
    content: "";    
    display: table;    
    clear: both;    
  }   
  
  .fa:hover {
    opacity: 0.7;
}
h2{
  text-align:center;

  font-size:30px;
 

}
#bn{
  position: absolute;
  top:10px;
  left:10%;
  color:#ffffff;
font-weight: bold;
}

</style>
</head>
<body style="background-color: 	#FDF5E6 ;">
  
<h2>Enter Project Details</h2>  
  <br>
<div class="container">  
    <form method="POST">    
      <div class="row">    
        <div class="col-25">    
          <label for="fname">Project Title</label>    
        </div>    
        <div class="col-75">    
          <input type="text"  name="ptitle" placeholder="Project title.." required>    
        </div>    
      </div>    
        
      <div class="row">    
        <div class="col-25">    
          <label for="feed_back">Project Description</label>    
        </div>    
        <div class="col-75">    
          <textarea  name="desc" placeholder="Write project description.." style="height:200px" required></textarea>    
        </div>    
      </div>
      
      <div class="row">    
        <div class="col-25">    
          <label for="fname">Starting Date</label>    
        </div>    
        <div class="col-75">    
          <input type="date"  name="date" placeholder="Starting date of project.." required>    
        </div>    
      </div>

      <div class="row">    
        <div class="col-25">    
          <label for="fname">Ending Date</label>    
        </div>    
        <div class="col-75">    
          <input type="date"  name="edate" placeholder="Ending date of project.." required>    
        </div>    
      </div>

      <div class="row">    
        <div class="col-25">    
          <label for="fname">Available Manager</label>    
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
              $un = $row1['user_name'];
            }
          }
        }
          if(!empty($un)){
      ?>  
      
      <div class="row">
        <div class="col-75">
        <label><?php echo $un;?></label>  
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
          <label for="fname">Available Employee</label>    
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
              $eun = $row1['user_name'];
            }
          }
        }
          if(!empty($eun)){
      ?>  
      
      <div class="row">
        <div class="col-75">

        <label><?php echo $eun;?></label> 
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

?> 

      <div class="row">   
         <a href="view_project.php?un=<?php echo $user_name ?>"><input type="button" class="btn btn-info" value="View" name="View">  </a>
        <input type="submit" value="Submit" name="submit">  
        <!-- <a class="btn btn-info" href="view.php">view</a>   -->
      </div>    
    </form>    
  </div>  

  <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>
</body>
<!-- <input name="favorites[]" type="text"> -->
</html>
<?php $conn->close();?>
