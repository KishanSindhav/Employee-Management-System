<?php 

include "config.php";

$sql = "SELECT * FROM notification order by `time` desc";

$result = $conn->query($sql);



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
      .one{
         height:25%;
         width: 30%;
      }
      .p1{
        position:absolute;
        top:10%;
        padding: 15px 430px;
        font-size:25px;
      }
      .p2{
        font-size:25px;
        padding:1px 1px;
      }
      .two{
        position: absolute;
    top: 65%;
    padding: 1px 800px;
    height: 51%;
    width: 41%;
         
      }
    </style>

<style>
        div.news{
           
        }
        #title{
            font-size:25px;
            border:1px solid black;
            background-color:lightblue;
            width:100%;  
        }

        #content{
            text-align:left ;
            font-size:15px;
        }

       
    </style>


</head>
<body style="background-color: 	#FDF5E6 ;">
    <div class="navbar1">
        <img class="logo1" src="photos\logo.jpg" alt="logo">
        <h3>HR INDUSTRY</h3>

        <ul>
            <li class="ab1" ><a href="index.php?un=<?php echo $user_name ?>">Home</a></li>
            <li class="active1"><a href="p2.php?un=<?php echo $user_name ?>">Notification</a></li>
            <li><a href="view_project.php?un=<?php echo $user_name ?>">Project</a></li>
            <li><a href="p4.php?un=<?php echo $user_name ?>">About</a></li>
            <div class="dropdown">
              <button class="dropbtn">...
                <i class="fa fa-caret-down"></i>
              </button>
              <div class="dropdown-content">
              <a href="user_detail.php?un=<?php echo $user_name ?>">Your details</a>
              <a class="btn btn-info" href="comm_manager.php?un=<?php echo $user_name;?>">Communicate</a>

               </div>
            </div>
        </ul>

    </div>
<br><br><br><br>

    <?php
    if ($result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

    ?>

        <div class="news">
        <table id="table">
            <tr>
                <th id="title"><pre><p><?php echo $row['title'] ?></p></pre></th>
            </tr>    
            <tr>
                <th id="content"><pre><p><?php echo $row['content'] ?></p></pre><th>
            </tr>  
            <tr>
                <th id="content"><pre><p><?php echo $row['time'] ?></p></pre><th>
            </tr>     

        </table>
        </div>
   <?php
        }
    }
    

    ?>
</body>
</html>