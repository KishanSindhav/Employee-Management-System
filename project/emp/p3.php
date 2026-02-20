<?php 

include "config.php";

  if (isset($_POST['submit'])) {

    $first_name1 = $_POST['firstname'];

    $last_name1 = $_POST['lastname'];

    $email1 = $_POST['mailid'];

    $feedback = $_POST['subject'];

    $uid = $_POST['uid'];

    $_pid = $_POST['pid'];

    $sql1 = "INSERT INTO `feedback`(`pid`,`uid`,`first_name`, `last_name`, `email`, `feedback`) 
            VALUES ('$_pid','$uid','$first_name1','$last_name1','$email1','$feedback')";

       $result1 = $conn->query($sql1);



    if ($result1 == TRUE) {

      // alert('Your feedback is given')";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

 

  }

  ?>

  <?php

if(isset($_GET['un'])) {

  $user_name = $_GET['un'];
  $pid = $_GET['pid'];
  $ptitle = $_GET['ptitle'];


     $sql = "SELECT * FROM `user_detail` WHERE `user_name`='$user_name'";

    $result = $conn->query($sql); 

 

      if ($result->num_rows > 0) {        
  
          while ($row = $result->fetch_assoc()) {

              $uid = $row['uid'];
  
              $first_name = $row['first_name'];  
  
              $last_name = $row['last_name'];  
          
              $email = $row['email'];  
          
          } 

        }

      }

      $conn->close()
  
      ?>
  
  




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="p1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
    color:#FAEBD7;
}

.fa-facebook {
  background: #3B5998;
  color: white;
}


.fa-instagram {
  background: #125688;
  color: white;
}
.fa-twitter {
  background: #125688;
  color: white;
}
.fa {
  padding: 12px 15px;
  font-size: 30px;

  text-decoration: none;
  text-align: center;
  border-radius: 50%; 
  max-width: 500px;
  margin: auto;
}
#bn{
  position: fixed;
  top:10px;
  left:3%;
  
}
h2{
  text-align: center;
}
      
  /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */    
  </style>    
  </head>    
  <body style="background-color: 	#FDF5E6 ;">  
    <!-- <div class="navbar2">
      <img class="logo2" src="photos\logo.jpg" alt="logo">
      <h3>HR INDUSTRY</h3>

      <ul>
          <li class="ab2" ><a href="index.php?un=<?php echo $user_name ?>">Home</a></li>
          <li><a href="p2.php?un=<?php echo $user_name ?>">Notification</a></li>
          <li class="active2"><a href="view_project.php?un=<?php echo $user_name ?>">Project</a>
          </li>
          <li><a href="p4.php?un=<?php echo $user_name ?>">About</a></li>
          <div class="dropdown">
              <button class="dropbtn">...
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
              <a href="user_detail.php?un=<?php echo $user_name ?>">Your details</a>
              <a href="view_project.php?un=<?php echo $user_name ?>">Project</a>
              <a class="btn btn-info" href="comm_manager.php?un=<?php echo $user_name;?>">Communicate</a>

                </div>
            </div>
      </ul>
  </div>   -->
  <br><br>
  <h2>FEED BACK FORM</h2>    
  <div class="container">    
    <form method="POST">    
    <div class="row">       
        <div class="col-75">    
          <input type="hidden" id="uid" name="uid" value="<?php echo $uid?>"  required>    
        </div>    
      </div>    
      <div class="row">    
        <div class="col-25">    
          <label for="fname">Project Id</label>    
        </div>    
        <div class="col-75">    
          <input type="text" id="pid" name="pid" value="<?php echo $pid?>"  required>    
        </div>    
      </div>   
      <div class="row">    
        <div class="col-25">    
          <label for="fname">Project Title</label>    
        </div>    
        <div class="col-75">    
          <input type="text" id="ptitle" name="ptitle" value="<?php echo $ptitle?>"  required>    
        </div>    
      </div>   
      <div class="row">    
        <div class="col-25">    
          <label for="fname">First Name</label>    
        </div>    
        <div class="col-75">    
          <input type="text" id="fname" name="firstname" value="<?php echo $first_name?>"  required>    
        </div>    
      </div>    
      <div class="row">    
        <div class="col-25">    
          <label for="lname">Last Name</label>    
        </div>    
        <div class="col-75">    
          <input type="text" id="lname" name="lastname" value="<?php echo $last_name?>">    
        </div>    
      </div>    
      <div class="row">    
          <div class="col-25">    
            <label for="email">Mail Id</label>    
          </div>    
          <div class="col-75">    
            <input type="email" id="email" name="mailid" value="<?php echo $email?>" required>    
          </div>    
        </div>       
      <div class="row">    
        <div class="col-25">    
          <label for="feed_back">Feed Back</label>    
        </div>    
        <div class="col-75">    
          <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px" required></textarea>    
        </div>    
      </div>    
      <div class="row">    
        <input type="submit" value="Submit" name="submit">  
        <!-- <a class="btn btn-info" href="view.php">view</a>   -->
      </div>    
    </form>    
  </div>    
  <div class="fa">
    <a href="https://www.facebook.com/" class="fa fa-facebook"></a>
    <a href="https://www.instagram.com/" class="fa fa-instagram"></a>
    <a href="https://www.twitter.com/" class="fa fa-twitter"></a>
    </div>

    <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>
    </body>
</html>