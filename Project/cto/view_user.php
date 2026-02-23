<?php

include "config.php";
include "../pdo.php";

session_start();
if($_SESSION['cto'] == true){

?>
<?php 


$sql = $connPDO->prepare("SELECT * FROM user_detail where `role`=1");
$sql->execute();
$sql1 = $connPDO->prepare("SELECT * FROM user_detail where `role`=2");
$sql1->execute();

  function paginate($data, $page, $pageSize) {
    // Calculate the offset.
    $offset = ($page - 1) * $pageSize;
  
    // Return the data for the current page.
    return array_slice($data, $offset, $pageSize);
  }

$rowData1 = $sql->fetchAll(PDO::FETCH_ASSOC);
$totalPages1 = ceil(count($rowData1) / 10);
$rowData2 = $sql1->fetchAll(PDO::FETCH_ASSOC);
$totalPages2 = ceil(count($rowData2) / 10);


// Validate the page number.
$Mpage = isset($_GET['Mpage']) ? $_GET['Mpage'] : 1;
$Epage = isset($_GET['Epage']) ? $_GET['Epage'] : 1;

// Paginate the data.
$dataData1 = paginate($rowData1, $Mpage, 10);
$dataData2 = paginate($rowData2, $Epage, 10);



?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">


</head>
<style>
        .bc,.navmain{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }
#bn{
  position: absolute;
  top:10px;
  left:10%;
  background-color: #009879;
  color:#ffffff;
font-weight: bold;
}
h2{
    text-align:center;
}
.chat{
    margin:0px 145px;
    
}
button, input, select, textarea {
    font-family: inherit;
    font-size: 25px;
    line-height: inherit;
}

tr:hover {
   color:#009879;
    font-weight: bold;
}
#sub{
    height: 36px;
    width: 80px;
    margin: 1px 20px;
}
.notification {
position: relative;
}
.notification .badge {
position: absolute;
top: -10px;
right: -10px;
padding: 5px 10px;
border-radius: 50%;
background: grey;
color: black;
}
</style>
<body style="background-color: aliceblue;">
<nav class="navbar navbar-expand-lg navmain " >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="../photos/logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
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
          <a class="nav-link text-capitalize" href="view_news.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-capitalize" href="view_user.php">User_details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="project.php">Project</a>
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
    
    <li><a class="dropdown-item" href="pending_user.php">Pending User_details</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="pending_news.php">Pending Notification</a></li>
    <li><hr class="dropdown-divider"></li>
    <li><a class="dropdown-item" href="leave.php">Leave Application</a></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>
<br>
<div class="container">

<h2>Managers</h2>


<table class="table table-striped" >

<thead>

<tr class="table-dark">

<th> ID</th>

<th>First Name</th>

<th>Last Name</th>

<th>Email</th>

<th>Address</th>

<th>Communicate</th>

<th>Attendance</th>


</tr>

</thead>

<tbody> 

<?php

    if (COUNT($dataData1) > 0) {

        foreach($dataData1 as $row){

?>

            <tr >

            <td><?php echo $row['uid']; ?></td>

            <td><?php echo $row['first_name']; ?></td>

            <td><?php echo $row['last_name']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['address']; ?></td>
            

            <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_cto where `uid` = '".$row['uid']."' and `is_cto`= '0' and `read_flag` = '0'");

                        
                        $data=mysqli_fetch_assoc($sql);
                        
                    if($data['msg'] > 0)
                    {
            ?>
                        <td>
                        <a class="btn btn-secondary notification"  href="http://localhost/project/communicate_cto.php?uid=<?php echo $row['uid']?>&me_un=CTO" >
                            <span>Communicate</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                         <!-- <a class="btn btn-info" href="http://localhost/project/communicate.php?uid=<?php echo $row['uid']; ?>">Communicate</a></td> -->
                    </tr>   
            <?php  

                    }else{

            ?>


            <td> <a class="btn btn-secondary" href="http://localhost/project/communicate_cto.php?uid=<?php echo $row['uid']?>&me_un=CTO">Communicate</a></td>

            <td><a class="btn btn-secondary" href="http://localhost/project/attendance.php?uid=<?php echo $row['uid']; ?>">View</a></td>
             </tr>                       

<?php       }

    }
  }

?>                

</tbody>

</table>

</div> 
<nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="?Mpage=<?php echo $Mpage - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php
        for ($i = 1; $i <= $totalPages1; $i++) {
        ?>
          <li class="page-item <?php if ($Mpage == $i) { echo 'active'; } ?>">
            <a class="page-link" href="?Mpage=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?Mpage=<?php echo $Mpage + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
<br><br><br>

    <div class="container">

        <h2>Employees</h2>


<table class="table table-striped" >

    <thead>

        <tr class="table-dark">

        <th> ID</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Email</th>

        <th>Address</th>

        <th>Attendance</th>

    </tr>

    </thead>

    <tbody> 

        <?php

        if (COUNT($dataData2) > 0) {

          foreach($dataData2 as $row){

        ?>

                    <tr >

                    <td><?php echo $row['uid']; ?></td>

                    <td><?php echo $row['first_name']; ?></td>

                    <td><?php echo $row['last_name']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['address']; ?></td>

                    <td><a class="btn btn-secondary" href="http://localhost/project/attendance.php?uid=<?php echo $row['uid']; ?>">View</a></td>

                      </tr>                       

        <?php       }

            }

        ?>                

    </tbody>

</table>

    </div> 
    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="?Epage=<?php echo $Epage - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php
        for ($i = 1; $i <= $totalPages2; $i++) {
        ?>
          <li class="page-item <?php if ($Epage == $i) { echo 'active'; } ?>">
            <a class="page-link" href="?Epage=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?Epage=<?php echo $Epage + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
    <br><br>
<div class="chat">
    <form action="chat.php" method="POST">
                <?php
                        $sql = "SELECT * FROM user_detail where `role`=1";
                        $sql1 = "SELECT * FROM user_detail where `role`=2";
                        $result = $conn->query($sql);
                        $result1 = $conn->query($sql1); 
                ?>

            <label for="name"><h2>Communication between Manager :</h2></label>
            <select name="man">
            
            <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {
            ?>
            <option size="200px" value="<?php echo $row['email'] ?>" name="man"><?php echo $row['first_name'] ?></option>
           
            <?php
                }
            }
            ?>
            </select>
            <label for="name"><h2> & Employee :</h2></label>
            <select name="emp">
            <?php

            if ($result1->num_rows > 0) {

                while ($row1 = $result1->fetch_assoc()) {
            ?>
            <option value="<?php echo $row1['email'] ?>" name="emp"><?php echo $row1['first_name'] ?></option>
           
            <?php
                }
            }
            ?>
            </select>
            
            <input id="sub" class="btn btn-secondary"  type="submit" name="submit">
    </form>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
     
</body>

</html>
<?php

        }

        ?>