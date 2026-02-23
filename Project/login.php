<?php

include "config.php";

session_start();

$_SESSION['TempUserNameLOL'] = "";
$_SESSION['TempUserPasswdLOL'] = "";

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login form with JavaScript Validation</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="style.css">

<?php 


$email = '';
$passwd = '';
$ch = '';
if (isset($_POST['submit'])){

  $email = $_POST['uemail'];
  $_SESSION['TempUserNameLOL'] = $_POST['uemail'];

  if(!preg_match('^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}^', $email))
  {
      $email = $email.'@gmail.com';
  }


  $passwd = md5($_POST['userPassword']);
  $_SESSION['TempUserPasswdLOL'] = $_POST['userPassword'];

  $ch = 'y';

  if($email == 'cto2023@gmail.com' && $passwd == 'f037447b331e2738f99e69e50e852fe3'  )
  {
    $_SESSION['cto']=true;
    $_SESSION['MessageLogIn'] = FALSE;
    $_SESSION['TempUserNameLOL'] = NULL;
    $_SESSION['TempUserPasswdLOL'] = NULL;
    header("Location: cto\index.php");
  }

}

if($ch == 'y'){

  $sql = " SELECT * FROM user_detail where `email` = '".$email."' and `password` = '".$passwd."'";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){




    if($row['role']==1 )
    {
      $date = date('Y-m-d');
      //echo $date;
      $check = $conn->query("SELECT uid from attendance where `uid`='".$row['uid']."' and `date`='".$date."'");

      if(!($row1= $check->fetch_assoc()))
      {
          $sql = $conn->query("INSERT into attendance(uid,date) values ('".$row['uid']."',now())");

          $sql2 = $conn->query("INSERT into tempCount(uid,date,lTime) values ('".$row['uid']."',now(),now())");

          //echo 'Run IF';
          $_SESSION["uemail"] = $email;
          $_SESSION["uid"] = $row['uid'];
          $_SESSION['MessageLogIn'] = FALSE;
          $_SESSION['TempUserNameLOL'] = NULL;
          $_SESSION['TempUserPasswdLOL'] = NULL;
          

          header("Location: manager\index.php");
      }
      else{
        $sql2 = $conn->query("INSERT into tempCount(uid,date,lTime) values ('".$row['uid']."',now(),now())");
        //echo 'Run Else';
        $_SESSION["uemail"] = $email;
        $_SESSION["uid"] = $row['uid'];
        $_SESSION['MessageLogIn'] = FALSE;
        $_SESSION['TempUserNameLOL'] = NULL;
        $_SESSION['TempUserPasswdLOL'] = NULL;
        header("Location: manager\index.php");
      }
      
    }
    else if($email ==  $row['email'] &&  $passwd ==  $row['password'] &&  $row['role']==2)
    {
      $date = date('Y-m-d');
      //echo $date;
      $check = $conn->query("SELECT uid from attendance where `uid`='".$row['uid']."' and `date`='".$date."'");

      if(!($row1= $check->fetch_assoc()))
      {
          $sql = $conn->query("INSERT into attendance(uid,date) values ('".$row['uid']."',now())");

          $sql2 = $conn->query("INSERT into tempCount(uid,date,lTime) values ('".$row['uid']."',now(),now())");

          //echo 'Run IF';
          $_SESSION["uemail"] = $email;
          $_SESSION["uid"] = $row['uid'];
          $_SESSION['MessageLogIn'] = FALSE;
          $_SESSION['TempUserNameLOL'] = NULL;
          $_SESSION['TempUserPasswdLOL'] = NULL;

          header("Location: emp\index.php");
      }
      else{
        $sql2 = $conn->query("INSERT into tempCount(uid,date,lTime) values ('".$row['uid']."',now(),now())");
        //echo 'Run Else';
        $_SESSION["uemail"] = $email;
        $_SESSION["uid"] = $row['uid'];
        $_SESSION['MessageLogIn'] = FALSE;
        $_SESSION['TempUserNameLOL'] = NULL;
        $_SESSION['TempUserPasswdLOL'] = NULL;
        header("Location: emp\index.php");
      }

        
    }

          
}  


}

else{
  ?>
<script>
 alert("Incorrect email or password");
</script>
<?php
}
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login form with JavaScript Validation</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">

<style>
  #role{
    padding:8px 82px;
    
  }
  option{
    text-align:left;
  }

  .bc,nav{
  background-color:lightyellow;
 }
</style>

</head>
<body>
<nav class="navbar navbar-expand-lg " >
  <div class="container">
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
   <ul class="dropdown-menu bc ">
    
    <li><a class="dropdown-item" href="sign_up.php">Sign Up</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item " href="login.php">Log In</a></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>



<div class="wrapper">
  <div class="inner-warpper text-center">
    <h2 class="title">Login</h2>
    <form action="" id="formvalidate" method="POST">
      <div class="input-group">
        <label class="palceholder" for="email"></label>
        <input class="form-control" name="uemail" id="email" type="text" placeholder="Email" value="<?php echo $_SESSION['TempUserNameLOL'] ?>" require />
        <span class="lighting"></span>
      </div>

     

      <div class="input-group">
        <label class="palceholder" for="userPassword"></label>
        <input class="form-control" name="userPassword" id="userPassword" type="password" placeholder="Password" value="<?php echo $_SESSION['TempUserPasswdLOL'] ?>" require/>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
</html>


