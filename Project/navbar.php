<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="p1.css"> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
 
 .bg-image{
   background-image: url('photos\\bgpic.jpg');
   background-repeat: no-repeat;
   background-attachment: fixed;
   background-size: 100% 100%;
 }
 .active{
  text-decoration: underline;
 }
 
 .bc,nav{
  background-color:lightyellow;
 }

</style>
</head>

<body class="bg-image" >
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
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
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
  <ul class="dropdown-menu bc " >
    
    <li><a class="dropdown-item" href="sign_up.php">Sign Up</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="login.php">Log In</a></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>


</body>
</html>