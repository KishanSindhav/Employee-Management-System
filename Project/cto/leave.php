<?php

include 'config.php';
include '..\pdo.php';

session_start();

$dataL = $connPDO->prepare("SELECT * FROM emp_leave");
$dataL->execute();
$rowData = $dataL->fetchAll(PDO::FETCH_ASSOC);
// Get the total number of pages.
$totalPages = ceil(count($rowData) / 10);

// Validate the page number.
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Paginate the data.
$dataData = paginate($rowData, $page, 10);

function paginate($data, $page, $pageSize) {
  // Calculate the offset.
  $offset = ($page - 1) * $pageSize;

  // Return the data for the current page.
  return array_slice($data, $offset, $pageSize);
}

// ====== APPROVE / REJECT LOGIC (NEW CODE ADDED) ======
if(isset($_GET['approve'])){
    $leaveId = $_GET['approve'];
    $stmt = $connPDO->prepare("UPDATE emp_leave SET status = 1 WHERE id = :id");
    $stmt->bindParam(':id',$leaveId);
    $stmt->execute();
    header("Location: leave.php");
    exit();
}

if(isset($_GET['reject'])){
    $leaveId = $_GET['reject'];
    $stmt = $connPDO->prepare("UPDATE emp_leave SET status = 2 WHERE id = :id");
    $stmt->bindParam(':id',$leaveId);
    $stmt->execute();
    header("Location: leave.php");
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
    
    <style>
        .bc,.navMain{
      background-color:lightyellow;
    }
  
    .active{
      text-decoration: underline;
    }
    .notification {

    color: black;
    text-decoration: none;
    padding: 7px 10px;
    position: relative;
    display: inline-block;
    border-radius: 2px;
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
  </head>
<body style="background-color: aliceblue;">
<nav class="navbar navbar-expand-lg navMain" >
  <div class="container" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="..\photos\logo.jpg" alt="Logo" width="45" height="35" class="d-inline-block align-text-top">
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
          
           <?php
          
            $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_cto where `is_cto`= '0' and `read_flag` = '0'");

                        
            $data=mysqli_fetch_assoc($sql);
             
                    if($data['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="view_user.php" >
                            <span>User_details</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="notification dropdown-item" href="view_user.php">User_details</a>
                
            <?php } ?>
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
    <center><h2>Leave Applications</h2></center>
    <br>
    <div class="container">
        <table class="table table-striped">
            <tr>
    <th>User ID</th>
    <th>Name</th>
    <th>Reason</th>
    <th>Start date</th>
    <th>End date</th>
    <th>Document</th>
    <th>Status</th>
    <th>Action</th>
</tr>

            <?php
            foreach ($dataData as $row) {
            ?>
                <tr>
                    <td><?php echo $row['uid']; ?></td>
                    <?php 
                    $nameUser = $connPDO->prepare("SELECT `first_name`,`last_name` from `user_detail` where `uid` = :uid");
                    $nameUser->bindParam(':uid',$row['uid']);
                    $nameUser->execute();
                    $rUserName = $nameUser->fetchAll(PDO::FETCH_ASSOC);
                    ?>

                    <td><?php echo $rUserName[0]['first_name']." ".$rUserName[0]['last_name'] ?></td>
                    <td><?php echo $row['reason']; ?></td>
                    <td><?php echo $row['sdate']; ?></td>
                    <td><?php echo $row['edate']; ?></td>
                    <td><a href="../leave_doc/<?php echo $row['path']; ?>"><?php echo $row['path']; ?></a></td>
                    <td>
<?php 
if($row['status'] == 0){
    echo "<span class='badge bg-warning text-dark'>Pending</span>";
}
elseif($row['status'] == 1){
    echo "<span class='badge bg-success'>Approved</span>";
}
else{
    echo "<span class='badge bg-danger'>Rejected</span>";
}
?>
</td>

<td>
<?php if($row['status'] == 0){ ?>
    <a href="?approve=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Approve</a>
    <a href="?reject=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Reject</a>
<?php } else { ?>
    <span class="text-muted">Action Taken</span>
<?php } ?>
</td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>

    <nav aria-label="Page navigation">
      <ul class="pagination justify-content-center">
        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>

        <?php
        for ($i = 1; $i <= $totalPages; $i++) {
        ?>
          <li class="page-item <?php if ($page == $i) { echo 'active'; } ?>">
            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
        <?php
        }
        ?>

        <li class="page-item">
          <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      </ul>
    </nav>
</body>
</html>
