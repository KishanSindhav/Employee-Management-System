<?php 

include "config.php";

  if (isset($_POST['submit'])) {

    $first_name = $_POST['firstName'];

    $last_name = $_POST['lastName'];

    $role = $_POST['role'];

    $email = $_POST['email'];

    $address = $_POST['address'];

    $password = md5($_POST['Password']);

    $sql = "INSERT INTO `temp`( `first_name`, `last_name`,`role`, `email`,`address`,`Password`) 
            VALUES ('$first_name','$last_name','$role','$email','$address','$password')";

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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet" />

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">


function validate(){
  var role = document.form.role.value;
  var passwd = document.form.Password.value;
  var conpasswd = document.form.confirmPassword.value;

  if(role == 0){  
  alert("Enter Your Role.");  
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
<style>
  input[type="submit"] {
    width: 301px;
    height: 37px;
    margin-top: 20px;
    border: none;
    background-color: #49c1a2;
    color: white;
    font-size: 18px;
    cursor: pointer;
  }
body {
    background-color: #344a72;
    font-family: "Roboto", sans-serif;
  }
 .signup-box{
  width: 460px;
    height: 745px;
    margin: auto;
    background-color: white;
    border-radius: 21px;
    position: relative;
    top: 51px;

         }

         form{
           width : 300px;
           margin-left : 70px;
         }
         .radiobtn{
          border:1px solid black;
         }

h1 {
    text-align: center;
    color: #49c1a2;
    padding-top: 20px;
  
  }
  .bc,nav{
  background-color:lightyellow;
 }

</style>
</head>

<body>
<nav class="navbar navbar-expand-lg  " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="photos\logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
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
          <a class="nav-link text-capitalize" href="login.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="login.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
  <button class="btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
       More Option    
  </button>
  <ul class="dropdown-menu bc">
    
    <li><a class="dropdown-item " href="sign_up.php">Sign Up</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="login.php">Log In</a></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>
  <div class="signup-box">

    <h1>Sign Up</h1>
    
    <form  action="" id="formvalidate" name="form" onsubmit="return validate()" method="POST" >

      <label class="palceholder" for="firstName"> First Name</label>
      <input class="form-control" name="firstName" type="text"  placeholder="Enter Your First Name" required />
      <span class="lighting"></span>

      <label class="palceholder" for="lastName"> Last Name</label>
      <input class="form-control" name="lastName" type="text"  placeholder="Enter Your Last Name" required />
      <span class="lighting"></span>

     
      <label class="palceholder" for="role">Role</label>
      <select class="form-control" name="role" id="role" >
      <option name="role" value="0">Choose Your Role</option>
      <option name="role" value="1" >Manager</option>
      <option name="role" value="2" >Employee</option>
      </select>
    
      <label class="palceholder">Email</label>
      <input type="email" class="form-control" placeholder="Enter Your Email" required  name="email"/>

      <label class="palceholder" for="Address">Address</label>
      <input class="form-control" name="address" type="text"  placeholder="Enter Your Address " required />
      <span class="lighting"></span>

      <label class="palceholder" for="txtPassword">Password</label>
      <input class="form-control" name="Password" type="Password" id="txtPassword" placeholder="Enter Minimum 8 character" required/>
      <span class="lighting"></span>

      <label class="palceholder">Confirm Password</label>
      <input type="password" class="form-control" id="txtConfirmPassword" name="confirmPassword" placeholder="Enter Minimum 8 character " required/>
      <input type="submit" class="form-control" class="button" value="Submit" name="submit" />
    </form>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>


</body>

</html>