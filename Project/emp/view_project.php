<?php

include "config.php";
session_start();

$i=1;

$uid = '';

if(isset($_SESSION['uemail'])) {

$user_name = $_SESSION['uemail'];

$sql = "SELECT * FROM user_detail where `role`=2 ";

$result = $conn->query($sql);

if($result -> num_rows > 0 ){

    while($row = $result -> fetch_assoc()  ){

        if($row['email']==$user_name)
        {
            $uid = $row['uid'];
        }
        
    }
}

}

?>
<?php 

include "config.php";

$sql1 = "SELECT * FROM project_detail where `uid`=$uid ";

$result1 = $conn->query($sql1);

if($result1)
{
    // echo 'result1';
}

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
.bc,nav{
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

tr:hover {
   color:#009879;
    font-weight: bold;
}
h2{
    text-align:center;
}
button{
    border:none;
    background:none;
    font-weight: bold;
    
}
button:hover{
    color:#009879;
}

</style>
</head>

<body style="background-color: aliceblue ;">
<nav class="navbar navbar-expand-lg  " >
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
          <a class="nav-link text-capitalize" href="p2.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-capitalize" href="view_project.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
         <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_emp_man where `uid` = '".$uid."'and `read_flag` = '0'");
                    $data=mysqli_fetch_assoc($sql);
                     
                    if($data['msg'] > 0)
                    {
                    
                ?>
                        <td>
                        <button class="notification btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>  More Option  </span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                            </button></td>
                     </tr>   
            <?php  

                    }else{

            ?>
                <button class="btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                 More Option                           
                </button>
                
            <?php } ?>
  <ul class="dropdown-menu bc " >
    
    <li><a class="dropdown-item" href="user_detail.php">Your Details</a></li>
    <li><hr class="dropdown-divider"></li>
    <li> <?php
                        
       
                        
                    if($data['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="comm_manager.php" >
                            <span>Communicate</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="comm_manager.php">Communicate</a>
                
            <?php } ?></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="leave.php">Leave</a></li>
    
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>

    <div class="container">

        <h2>Project</h2>


<table class="table table-striped">

    <thead>

        <tr class="table-dark">

        <th>ID</th>

        <th>Project Title</th>

        <th>Starting Date</th>

        <th>Ending Date</th>

        <th>Action</th>

        </tr>
   

    </thead>

    <tbody> 

<?php

    if ($result1->num_rows > 0) {
        while ($row1 = $result1->fetch_assoc()) {
            
            $pid = $row1['pid'];
            $pd = "SELECT * from project where `pid` = $pid ";
            $resPD = $conn->query($pd);
            
?> 
            <tr>

            
            <td><?php echo $row1['pid']; ?></td>

            
<?php
            if ($resPD->num_rows > 0) {
                while ($prow = $resPD->fetch_assoc()) {
                   
?>
            <td><button class="b<?php echo$i; ?>"><?php echo $prow['ptitle']; ?></button></td>

            <td><?php $d=$prow['startDate'];$d1=date("d-m-Y",strtotime($d));echo $d1; ?></td>

            <td><?php $d2=$prow['endDate'];$d3=date("d-m-Y",strtotime($d2));echo $d3; ?></td>

             <td><a class="btn btn-secondary" href="p3.php?pid=<?php echo $row1['pid'] ?>&ptitle=<?php echo $prow['ptitle'] ?>">Feedback</a></td>
             
             </tr>

             <tr>
             <th class="re<?php echo$i; ?>" style="display:none;">Description</th>
             <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $prow['description'];?></td>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             </tr>
             <tr><th class="re<?php echo$i;?>" style="display:none;">Project Manager</th>
             <th class="re<?php echo$i; ?>" style="display:none;">Employees</th>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             <td class="re<?php echo$i; ?>" style="display:none;"></td>
             </tr>
             <tr>
             <?php
                }
            }

            $uidpd = "SELECT * from project_detail where `pid` = $pid ";
            $resUPD = $conn->query($uidpd);
            if ($resUPD->num_rows > 0) {
                $temp=TRUE;

                while ($uprow = $resUPD->fetch_assoc()) {
            
            $id = $uprow['uid'];
                $user = $conn->query("SELECT * from `user_detail` where `uid`= '".$id."'");
                $uname = '';
                while ($u = $user->fetch_assoc()) {
                    $fname = $u['first_name'];
                    $lname = $u['last_name'];
                }
            ?>
            
            <td class="re<?php echo$i; ?>" style="display:none;"><?php if($temp){echo $fname."  ".$lname;$temp=FALSE;echo "</td>
                <td class=\"re".$i."\" style=\"display:none;\"></td>
                <td class=\"re".$i."\" style=\"display:none;\"></td>
                <td class=\"re".$i."\" style=\"display:none;\"></td>
                <td class=\"re".$i."\" style=\"display:none;\"></td></tr>";continue;}?>
               
                <td class="re<?php echo$i; ?>" style="display:none;"><?php echo  $fname."  ".$lname;?>
                </td>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>

                </tr> 
                
            <?php
                }
                ?>
                <tr>
                <th class="re<?php echo$i; ?>" style="display:none;">Task</th>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>
                <td class="re<?php echo$i; ?>" style="display:none;"></td>
                <td class="re<?php echo$i; ?>" style="display:none;">
                <?php
                $tdata = $conn->query("SELECT * from `task` where `uid`= '".$uid."' and `pid` = '".$pid."'");
                if($tdata->num_rows > 0)
                {
                    $n=1;
                    while($td = $tdata->fetch_assoc())
                    {
                        ?>
                        <tr>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;">
                        <?php
                        echo $n.")\n".$td['ntask']."<br>";
                        $n++;
                        echo "</td>";
                        if($td['done_flag']==0)
                        {
                        ?>
                        <td class="re<?php echo$i; ?>" style="display:none;">
                        <a class="btn btn-secondary" href="done.php?tid=<?php echo $td['id']?>&pid=<?php echo $pid?>">Done</a>
                        
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        
                        </tr>
                        <?php
                        }
                        else{
                            
                            echo "<td class=\"re".$i."\" style=\"display:none;\">";
                            echo "<p>&#10004 </p>";
                            echo "<td class=\"re".$i."\" style=\"display:none;\">";
                            echo "<td class=\"re".$i."\" style=\"display:none;\">";
                            
                            echo "</td>";
                           
                        }
                    
                    }
                }
                ?>
                </tr>
                
             
           
           
                
            <script>
$(document).ready(function(){
$(".b<?php echo$i; ?>").click(function(){
    $(".re<?php echo$i; ?>").toggle();
});
});

</script>
<script>
$(document).ready(function(){
$("#btv").click(function(){
    $(".tv").toggle();
});
});

</script>
                              

<?php    $i++;  }

    }
}


?>                

</tbody>

</table>

    </div> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
     
</body>

</html>
