<?php

include "config.php";

session_start();

$i=1;

$uid = '';

if(isset($_SESSION['uemail'])) {

$user_name = $_SESSION['uemail'];

$sql = "SELECT * FROM user_detail where `role`=1 ";

$result = $conn->query($sql);

if($result -> num_rows > 0 ){

    while($row = $result -> fetch_assoc()  ){

        if($row['email']==$user_name)
        {
            $uid = $row['uid'];
            //echo $uid;
        }
        
    }
}

}
if(isset($_POST['submit'])){
    
    $task = $_POST['task'];

    $_uid = $_POST['uid'];

    $_pid = $_POST['pid'];

    $sql = "INSERT INTO `task`(`ntask`,`uid`, `pid`) 
            VALUES ('$task','$_uid','$_pid')";

    $result = $conn->query($sql);


}



?>
<?php 

$sql1 = "SELECT * FROM project_detail where `uid`= '".$uid."'";

$result1 = $conn->query($sql1);

$r1 = $conn->query($sql1);

$r1Pid = 0;

if($r1 && $r1->num_rows > 0){
    $rowpid = $r1->fetch_assoc();
    $r1Pid = $rowpid['pid'];
}

$doneP = 0; // default value

$doneQuery = $conn->query("SELECT `completedflag` 
                           FROM `project_detail` 
                           WHERE `pid` = $r1Pid 
                           AND `completedflag` = 1");

if($doneQuery && $doneQuery->num_rows > 0){
    $doneRow = $doneQuery->fetch_assoc();
    $doneP = $doneRow['completedflag'];
}

if($doneP == '1')
{
}
else{
$tt = $conn->query("SELECT COUNT(done_flag) as doneCount from `task` where `done_flag` = '1' and `pid`=$r1Pid");
$tCount = $conn->query("SELECT COUNT(ntask) as total from `task` where `pid`=$r1Pid");
if($tt)
	$ttCount = mysqli_fetch_assoc($tt)["doneCount"];
if($tCount)
$totalCount = mysqli_fetch_assoc($tCount)["total"];
 
}
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

tr:hover {
   
    font-weight: bold;
}
.bb:hover{
    background-color:green;
    font-weight: bold;
}
.b1:hover{
    color:#009879;
    font-weight: bold;
}
h1{
    text-align:center;
}
button{
    border:none;
    background:none;
    font-weight:bold;
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

<body style="background-color:aliceblue ;">
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
          <a class="nav-link text-capitalize" href="news.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-capitalize" href="view_project.php">Project</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="leave.php">Leave</a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-capitalize" href="p4.php">About</a>
        </li>
        <li class="nav-item">
        <div class="dropdown">
        <?php
                        
                        $sql = $conn->query("SELECT COUNT(read_flag) as msg from comm_emp_man where `uid` = '".$uid."'  and `read_flag` = '0'");
                        $sql1 = $conn->query("SELECT COUNT(read_flag) as msg from comm_cto where `uid` = '".$uid."' and `is_cto`= '1' and `read_flag` = '0'");

                        
                        $data=mysqli_fetch_assoc($sql);
                        $data1=mysqli_fetch_assoc($sql1);
                        
                    if($data['msg'] > 0 || $data1['msg'] >0)
                    {
                      $totalmsg = (int)$data['msg'] + (int)$data1['msg'];
                ?>
                        <td>
                        <button class="notification btn dropdown-toggle "  type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>  More Option  </span>
                            <span class="badge"><?php echo $totalmsg ?></span>
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
                        <a  class="dropdown-item notification" href="view_user.php" >
                            <span>Employee Details</span>
                            <span class="badge"><?php echo $data['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="view_user.php">Employee Details</a>
                
            <?php } ?></li>
    <li><hr class="dropdown-divider"></li>
    <li> <?php
                        
                       
                        
                    if($data1['msg'] > 0)
                    {
                ?>
                        <td>
                        <a  class="dropdown-item notification" href="http://localhost/project/communicate_cto.php?me_un=manager" >
                            <span>CTO Messages</span>
                            <span class="badge"><?php echo $data1['msg'] ?></span>
                        </a>
                     </tr>   
            <?php  

                    }else{

            ?>
                <a class="dropdown-item" href="http://localhost/project/communicate_cto.php?me_un=manager">CTO Messages</a>
                
            <?php } ?></li>
  </ul>
</div>
</li>
      </ul>
      
    </div>
  </div>
</nav>
<br><br>

    <div class="container">

        <h1>Project</h1>
 <br>

 <?php

 if($doneP == '1'){
 }
 else{
?>

<table class="table table-striped" >

    <thead>

        <tr class="table-dark">

        <th>ID</th>

        <th>Project Title</th>

        <th>Starting Date</th>

        <th>Ending Date</th>

        <th>Action</th>

        <th>Analysis</th>

        <?php
        if(isset($ttCount))
        if($ttCount == $totalCount)
        {
        ?>
        <th>Complete Project</th>
        <?php
        }
        ?>

        </tr>
   

    </thead>

    <tbody> 

        <?php

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $pid = $row1['pid'];
                    $pd = "SELECT * from project where `pid` = '".$pid."'";
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

                     <td><a class="btn btn-secondary" href="view.php?pid=<?php echo $pid ?>">View Feedback</a></td>

                     <td><a class="btn btn-secondary" href="analise.php?pid=<?php echo $pid ?>">Analise the task</a></td>

                     <?php
                        if($ttCount == $totalCount)
                        {
                        ?>
                        <td><a class="btn btn-secondary" href="doneProject.php?pid=<?php echo $pid ?>">Complete</a></td>
                        <?php
                        }
                    ?>
                     </tr>

                     <tr>
                     <th class="re<?php echo$i; ?>" style="display:none;">Description</th>
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $prow['description'];?></td>
                        <th class="re<?php echo$i; ?>" style="display:none;"></th>
                        <th class="re<?php echo$i; ?>" style="display:none;"></th>
                        <th class="re<?php echo$i; ?>" style="display:none;"></th>
                        <th class="re<?php echo$i; ?>" style="display:none;"></th>
                        <th class="re<?php echo$i; ?>" style="display:none;"></th>
                      </tr>
                     <tr><th class="re<?php echo$i; ?>" style="display:none;">Project Manager</th>
                     <th class="re<?php echo$i; ?>" style="display:none;">Employees</th>
                     <th class="re<?php echo$i; ?>" style="display:none;"></th>
                     <th class="re<?php echo$i; ?>" style="display:none;"></th>
                     <th class="re<?php echo$i; ?>" style="display:none;"></th>
                     <th class="re<?php echo$i; ?>" style="display:none;"></th>
                     <th class="re<?php echo$i; ?>" style="display:none;"></th>
                     
                     </tr>
                     <tr>
                     <?php
                        }
                    }

                    $uidpd = "SELECT * from project_detail where `pid` = $pid ";
                    $resUPD = $conn->query($uidpd);
                    if ($resUPD->num_rows > 0) {
                        $temp=TRUE;
                        
                        $q=1;$n=1;
                        while ($uprow = $resUPD->fetch_assoc()) {
                        
                        $id = $uprow['uid'];
                        $user = $conn->query("SELECT * from `user_detail` where `uid`= '".$id."'");
                        $uname = '';
                        while ($u = $user->fetch_assoc()) {
                            $fname = $u['first_name'];
                            $lname = $u['last_name'];
                        }
                    ?>
                    <!-- <td id="btv<?php echo$n; ?>" class="re<?php echo$i; ?>" style="display:none;"><a class="btn btn-info" >View Task</a></td> -->
                        <!-- <td class="tv" style="display:none;"> -->
                    
                    <td  class="re<?php echo$i; ?>" style="display:none;"><?php if($temp){echo $fname."  ".$lname;$temp=FALSE;echo "</td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        <td class=\"re".$i."\" style=\"display:none;\"></td>
                        
                        </tr>";continue;}?></td>
                    <td id="btv<?php echo $n; ?>" class="re<?php echo$i; ?>" style="display:none;"><?php echo $fname."  ".$lname;?></td>
                        <form action="" method="POST">
                        <td class="re<?php echo $i; ?>" style="display:none;">
                        <td class="re<?php echo $i; ?>" style="display:none;">
                        <?php
                        
                        $tdata = $conn->query("SELECT * from `task` where `uid`= 3 and `pid` = 3");
                        if($tdata->num_rows > 0)
                        {
                            
                            $m=1;
                            while($td = $tdata->fetch_assoc())
                            {
                                ?>
                                <tr>
                                <td class="tv<?php echo$n; ?>" style="display:none;"></td>
                                <td class="tv<?php echo$n; ?>" style="display:none;">
                                <?php
                                echo $m.")\n".$td['ntask']."<br>";
                                $m++;
                                echo "</td>";
                                if($td['done_flag']==0)
                                {
                                ?>
                                <td class="tv<?php echo$n; ?>" style="display:none;">
                                <p>Pending</p>
                                </td>
                                
                                </tr>
                                <?php
                                }
                                else{
                                    echo "<td class=\"tv".$n."\" style=\"display:none;\">";
                                    echo "<p>&#10004 </p>";
                                    echo "</td>";
                                   
                                }
                                ?>
                                
                                <?php
                                
                            }
                            ?>
                            <td class="tv<?php echo$n; ?>" style="display:none;"></td>
                            <td class="tv<?php echo$n; ?>" style="display:none;">
                                <input type="text" name="task" placeholder="Enter Task" required>
                                
                                <input type="hidden" name="pid" value="<?php echo $pid ?>">
                                
                                </td>
                                <input type="hidden" name="uid" value="<?php echo $uprow['uid'] ?>">
                                <td class="tv<?php echo$n; ?>" style="display:none;" style="display:none;">
                                <input class="bb btn btn-secondary" type="Submit" name="submit">
                                </form>
                                
                                </td>
                                <script>
                                $(document).ready(function(){
                                $("#btv<?php echo $n; ?>").click(function(){
                                    $(".tv<?php echo $n; ?>").toggle();
                                });
                                });

                                </script>
                                <?php
                        }
                    else{
                        ?>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                            <td class="re<?php echo$i; ?>" style="display:none;">
                                <input type="text" name="task" placeholder="Enter Task" required>
                                
                                <input type="hidden" name="pid" value="<?php echo $pid ?>">
                                
                                </td>
                                <input type="hidden" name="uid" value="<?php echo $uprow['uid'] ?>">
                                <td class="re<?php echo$i; ?>" style="display:none;" style="display:none;">
                                <input class="bb btn btn-secondary" type="Submit" name="submit">
                                </form>
                                <?php
                           
                    }
                        ?>
                        
                        <?php
                        
                        ?>
                        </tr> 
                        
                    <?php
                   $n++;$q++;
                        }
                        ?>
                        <tr>
                        
                        </tr>
                        <?php
                    }
                    ?>
                     
                    <!-- <td> <a class="btn btn-info" href="update_user.php?id=<?php echo $row1['empid'];?>">update</a></td>
                   
                    <td> -->
                   
                        
                    <script>
        $(document).ready(function(){
        $(".b<?php echo$i; ?>").click(function(){
            $(".re<?php echo$i; ?>").toggle();
        });
        });

    </script>
                                      

        <?php    $i++;  }

            }

        ?>                

    </tbody>

</table>

<?php
        }
?>
    </div> 
   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
      
</body>

</html>
