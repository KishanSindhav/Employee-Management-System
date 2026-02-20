<?php 

include "config.php";

  if (isset($_POST['submit'])) {

    $user_nmame = $_POST['userName'];

    $first_name = $_POST['firstName'];

    $last_name = $_POST['lastName'];

    $role = $_POST['role'];

    $email = $_POST['email'];

    $address = $_POST['address'];

    $password = $_POST['Password'];

    $sql = "INSERT INTO `temp`(`user_name`, `first_name`, `last_name`,`role`, `email`,`address`,`Password`) 
            VALUES ('$user_nmame','$first_name','$last_name','$role','$email','$address','$password')";

    $result = $conn->query($sql);

    if ($result == TRUE) {

      header("location:index.php");

    }else{

      echo "Error:". $sql . "<br>". $conn->error;

    } 

    $conn->close(); 

  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Sign Up | By Code Info</title>
  <link rel="stylesheet" href="sign.css" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">


function validate(){
  var user = document.form.userName.value;
  var passwd = document.form.Password.value;
  var conpasswd = document.form.confirmPassword.value;

  if(user.length<6){  
  alert("name must be at least 6 characters long.");  
  return false;  
  }  

  else if(passwd.length<8){  
  alert("Password must be at least 8 characters long.");  
  return false;  
  } 
  
  else if(passwd != conpasswd ){  
  alert("Password does not match ");  
  return false;  
  } 
  
}

  


</script>

</head>

<body>
  <p class="home">
    Go to Home Page <a href="index.php">click Here</a>
  </p>
  <div class="signup-box">
    <style>
        .signup-box{
          width: 456px;
          height: 922px;
          margin: auto;
          background-color: white;
          border-radius: 3px;

         }

         form{
           width : 300px;
           margin-left : 70px;
         }
         .radiobtn{
          border:1px solid black;
         }
        }
    </style>
    <h1>Sign Up</h1>
    <h4>It's free and only takes a minute</h4>
    <form  action="" id="formvalidate" name="form" onsubmit="return validate()" method="POST" >
      <label class="palceholder" for="userName"> User Name</label>
      <input class="form-control" name="userName" type="text" id="userName" placeholder="Enter Minimum 6 character" required />
      <span class="lighting"></span>

      <label class="palceholder" for="firstName"> First Name</label>
      <input class="form-control" name="firstName" type="text"  placeholder="Enter Your First Name" required />
      <span class="lighting"></span>

      <label class="palceholder" for="lastName"> Last Name</label>
      <input class="form-control" name="lastName" type="text"  placeholder="Enter Your Last Name" required />
      <span class="lighting"></span>

     
      <label  for="role">Role</label>
      <input  type="text" name="role" placeholder="Manager=1 , Employee=2"></input>
     

      <label>Email</label>
      <input type="email" placeholder="Enter Your Email" required  name="email"/>

      <label class="palceholder" for="Address">Address</label>
      <input class="form-control" name="address" type="text"  placeholder="Enter Your Address " required />
      <span class="lighting"></span>

      <label class="palceholder" for="txtPassword">Password</label>
      <input class="form-control" name="Password" type="Password" id="txtPassword" placeholder="Enter Minimum 8 character" required/>
      <span class="lighting"></span>

      <label>Confirm Password</label>
      <input type="password" id="txtConfirmPassword" name="confirmPassword" placeholder="Enter Minimum 8 character " required/>
      <input type="submit"  class="button" value="Submit" name="submit" />
    </form>
  </div>

</body>

</html>