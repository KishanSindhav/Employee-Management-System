<?php

include "config.php";

$i=1;

$uid = '';

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

$sql = "SELECT * FROM user_detail where `role`=1 ";

$result = $conn->query($sql);

if($result -> num_rows > 0 ){

    while($row = $result -> fetch_assoc()  ){

        if($row['user_name']==$user_name)
        {
            $uid = $row['uid'];
            // echo $uid;
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

    // foreach($_POST['task'] as $task & $_POST['uid'] as $uid){
    //     $sql = "INSERT INTO `task`(`ntask`,`uid`, `pid`) 
    //         VALUES ('$task','$_uid','$_pid')";
    //     $avlSet1 = $conn->query("UPDATE `avail` SET `avail_flag`=1 WHERE `uid`=$value");
    //   }
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

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>


#bn{
  position: absolute;
  top:10px;
  left:10%;
  background-color: #009879;
  color:#ffffff;
font-weight: bold;
}
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 1.2em;
    font-family: sans-serif;
    min-width: 1200px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}
.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
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
}
</style>
</head>

<body style="background-color: 	#FDF5E6 ;">

    <div class="container">

        <h2>Project</h2>


<table class="styled-table" style="background-color:#FAEBD7;">

    <thead>

        <tr>

        <th>ID</th>

        <th>Project Title</th>

        <th>Starting Date</th>

        <th>Ending Date</th>

        <th>Action</th>

        <th class="re<?php echo$i; ?>" style="display:none;"></th>
        

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

                     <td><?php echo $prow['startDate']; ?></td>

                     <td><?php echo $prow['endDate']; ?></td>

                     <td><a class="btn btn-info" href="view.php?un=<?php echo $user_name ?>&pid=<?php echo $pid ?>">View Feedback</a></td>

                     </tr>

                     <tr>
                     <th class="re<?php echo$i; ?>" style="display:none;">Description</th>
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $prow['description'];?></td>
                     </tr>
                     <tr><th class="re<?php echo$i; ?>" style="display:none;">Project Manager</th>
                     <th class="re<?php echo$i; ?>" style="display:none;">Employees</th>
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
                            $uname = $u['user_name'];
                        }
                    ?>
                    <!-- <td id="btv<?php echo$n; ?>" class="re<?php echo$i; ?>" style="display:none;"><a class="btn btn-info" >View Task</a></td> -->
                        <!-- <td class="tv" style="display:none;"> -->
                    
                    <td  class="re<?php echo$i; ?>" style="display:none;"><?php if($temp){echo $uprow['uid']."  (".$uname.")";$temp=FALSE;echo "</td><td class=\"re".$i."\" style=\"display:none;\"></td></tr>";continue;}?></td>
                    <td id="btv<?php echo$n; ?>" class="re<?php echo$i; ?>" style="display:none;"><button><?php echo $uprow['uid']."  (".$uname.")";?></button></td>
                        <form action="" method="POST">
                        <td class="re<?php echo$i; ?>" style="display:none;">
                        <?php
                        
                        $tdata = $conn->query("SELECT * from `task` where `uid`= '".$uprow['uid']."' and `pid` = '".$pid."'");
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
                                <input class="btn btn-info" type="Submit" name="submit">
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
                                <input class="btn btn-info" type="Submit" name="submit">
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

    </div> 
    <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>
</body>

</html>
