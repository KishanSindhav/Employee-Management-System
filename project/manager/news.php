<?php
include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}
$uid;
$sql = "SELECT * from `user_detail`";

$result = $conn->query($sql);

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

    $title = $_POST['title'];

    $content = $_POST['content'];

    $sql = "INSERT INTO `temp_notification`(`uid`,`title`, `content`, `time`) 
            VALUES ('$uid','$title','$content',now())";

    $result = $conn->query($sql);

    if ($result == TRUE) {

      // alert('Your feedback is given')";

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 

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
  position: fixed;
  top:10px;
  left:10%;
  
}

</style>
</head>
<body  style="background-color: 	#FDF5E6 ;">
  
<h2>Enter Notifications</h2>  
  <br>
<div class="container">  
    <form method="POST">    
      <div class="row">    
        <div class="col-25">    
          <label for="fname">Title</label>    
        </div>    
        <div class="col-75">    
          <input type="text"  name="title" placeholder="News title.." required>    
        </div>    
      </div>    
        
      <div class="row">    
        <div class="col-25">    
          <label for="feed_back">Content</label>    
        </div>    
        <div class="col-75">    
          <textarea  name="content" placeholder="Write news content.." style="height:200px" required></textarea>    
        </div>    
      </div>    
      <div class="row">   
         <a href="view_news.php?un=<?php echo $user_name ?>"><input class="btn btn-info" type="button" value="View" name="View">  </a>
        <input type="submit" value="Submit" name="submit">  
        <!-- <a class="btn btn-info" href="view.php">view</a>   -->
      </div>    
    </form>    
  </div>  

  <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>
</body>
</html>