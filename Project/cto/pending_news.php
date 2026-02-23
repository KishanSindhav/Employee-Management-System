<?php

include "config.php";

include "../pdo.php";

$i=1;

$dataL = $connPDO->prepare("SELECT * FROM temp_notification");
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

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<style>

.bc,.navMain{
  background-color:lightyellow;
 }
 .active{
  text-decoration: underline;
 }
h2{
    text-align:center;
}
button{
    border:none;
}

tr:hover {
   color:#009879;
    font-weight: bold;
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
<nav class="navbar navbar-expand-lg navMain " >
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
          <a class="nav-link  text-capitalize" href="p4.php">About</a>
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
<body style="background-color: 	aliceblue ;">

    <div class="container">
<br><br>
        <h2>Notification</h2>


<table class="table table-striped" >

    <thead>

        <tr class="table-dark">

        <th>ID</th>

        <th>Title</th>

        <th>Date</th>

        <th>Action</th>

        <th>Delete</th>

        </tr>
   

    </thead>

    <tbody> 

        <?php

if (COUNT($dataData) > 0) {

  foreach ($dataData as $row) {

        ?>

                    <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><button class="b<?php echo$i; ?>"><?php echo $row['title']; ?></button></td>

                     <td><?php $d=$row['time'];$d1=date("d-m-Y H:i:s",strtotime($d));echo $d1;?></td>

                     <td> <a class="btn btn-secondary" href="confirm.php?id=<?php echo $row['id']; ?>&n=news">Confirm</a></td>

                     <td> <a class="btn btn-danger" href="delete_news.php?id=<?php echo $row['id'];?>">Delete</a></td>

                     </tr>

                     <tr>
                     <td class="re<?php echo$i; ?>" style="display:none;"></td>
                    
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $row['content'];?></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                     </tr>

                     
                    
                   
                        
                    <script>
        $(document).ready(function(){
        $(".b<?php echo$i; ?>").click(function(){
            $(".re<?php echo$i; ?>").toggle(500);
        });
        });

    </script>
                                      

        <?php    $i++;  }

            }

        ?>                

    </tbody>

</table>
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

    </div> 
    
</body>

</html>
