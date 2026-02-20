<?php

include "config.php";

$sql = " SELECT * FROM user_detail ";

$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login form with JavaScript Validation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="style.css">

<?php 


$user = '';
$passwd = '';
$ch = '';
$role = '';
if (isset($_POST['submit'])){

  $user = $_POST['userName'];

  $passwd = $_POST['userPassword'];

  $role = $_POST['role'];

  $ch = 'y';

  if($user == 'CTO2023'&& $passwd == '8868858458' && $role == 0 )
  {
    header("Location: cto\index.php?un=CTO2023");
  }

}

if($ch == 'y'){
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){



    if($user ==  $row['user_name'] &&  $passwd ==  $row['password'] && $role == 1 && $role == $row['role'])
    {
      header("Location: manager\index.php?un=".$user);
      
    }
    if($user ==  $row['user_name'] &&  $passwd ==  $row['password'] && $role == 2 && $role == $row['role'])
    {
        header("Location: emp\index.php?un=".$user);
        
    }

   
}  
if($user !=  $row['user_name'] &&  $passwd !=  $row['password']){
  echo "Incorrect username or password";
?>
<script>
  alert("Incorrect username or password");
</script>
<?php
}       
}
}


?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login form with JavaScript Validation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="style.css">



</head>
<body>
<!-- partial:index.partial.html -->
<!-- <div class="logo text-center">
  <h1>Logo</h1>
</div> -->
<p class="home1" >
  Go to Home Page <a href="index.php">click Here</a>
</p>

<div class="wrapper">
  <div class="inner-warpper text-center">
    <h2 class="title">Login</h2>
    <form action="" id="formvalidate" method="POST">
      <div class="input-group">
        <label class="palceholder" for="userName"></label>
        <input class="form-control" name="userName" id="userName" type="text" placeholder="User Name" require />
        <span class="lighting"></span>
      </div>

      <div class="input-group">
        <label class="palceholder" for="role"></label>
        <input class="form-control" name="role" id="role" type="text" placeholder="Enter Your Role" require/>
        <span class="lighting"></span>
      </div>

      <div class="input-group">
        <label class="palceholder" for="userPassword"></label>
        <input class="form-control" name="userPassword" id="userPassword" type="password" placeholder="Password" require/>
        <span class="lighting"></span>
      </div>

      <button type="submit" id="login" name="submit" href="emp.php?empid=<?php echo $user;?>">Login</button>
      <!-- <div class="clearfix supporter">
        <div class="pull-left remember-me">
          <input id="rememberMe" type="checkbox">
          <label for="rememberMe">Remember Me</label> -->
        <!-- </div>
        <a class="forgot pull-right" href="#">Forgot Password?</a>
      </div> -->
    </form>
  </div>
  <div class="signup-wrapper text-center">
    <a href="sign_up.php">Don't have an accout? <span class="text-primary">Create One</span></a>
  </div>
</div>

<!-- you don't need that :)  -->
<!-- <div class="direction">
  Type something in input and click submit to see the effect
</div> -->
<!-- partial -->

<!-- <script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.15.0/jquery.validate.min.js'></script>
<script  src="script.js"></script> -->
</body>
</html>


