<?php

include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>

    <link rel="stylesheet" href="1.css">
    <link rel="stylesheet" href="p1.css">

    <style>
        .bg-text {
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
            border: 3px solid #f1f1f1;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
            width: 50%;
            height: 1px;
            padding: 20px;
        }


    </style>
</head>

<body class="bgimg">

    <div class="navbar">
        <img class="logo" src="photos\logo.jpg" alt="logo">
        <h3>HR INDUSTRY</h3>

        <ul>
            
            <li class="ab" id="active"><a href="index.php?un=<?php echo $user_name ?>">Home</a></li>
            <li><a href="news.php?un=<?php echo $user_name ?>">Notification</a></li>
            <li><a href="view_project.php?un=<?php echo $user_name ?>">Project</a></li>
            <li><a href="p4.php?un=<?php echo $user_name ?>">About</a></li>
            <div class="dropdown">
              <button class="dropbtn">...
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">

              <a href="user_detail.php?un=<?php echo $user_name ?>">Your Details</a>
                <a href="view_user.php?un=<?php echo $user_name ?>">Employee details</a>
                <a href="http://localhost/final_project/communicate_cto.php?un=<?php echo $user_name?>&me_un=CTO">CTO Messages</a>
                
        
                <!-- <a href="salary.php?un=<?php echo $user_name ?>">salary details</a> -->

                <!-- <a href="http://localhost/final_project/communicate.php?un=<?php echo $user_name ?>">Messages</a> -->
              </div>
            </div>

        </ul>

    </div>

    
<!-- <div class="dropdown">
    <button class="dropbtn">Other
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Announcement</a>
      <a href="#">Sign Up</a>
      <a href="login.html">Log in</a>
    </div>
  </div> -->
    <div class="bg-text">

        <h1>Employee Management</h1>

    </div>

    <div class="cn">

    <h2>Effortlessly manage your  employee data</h2>
    <p>Manage your  workforce with a flexible,
      employee database management system. <br>
      Build a secure,
      comprehensive, and scalable database to get a better understanding of your workforce.</p>
  <br>
    <div id="sbtxt">
     Log Out account  <a href="http://localhost/Final_project/index.php" id="sb">Log Out</a>
    </div>
      </div>>

</body>

</html>