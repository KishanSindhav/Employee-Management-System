<?php

include "config.php";

$i=1;


if(isset($_GET['un'])) {

$user_name = $_GET['un'];

// $sql = "SELECT * FROM user_detail where `role`=2 ";

// $result = $conn->query($sql);

// if($result -> num_rows > 0 ){

//     while($row = $result -> fetch_assoc()  ){

//         if($row['user_name']==$user_name)
//         {
//             $uid = $row['uid'];
//             // echo $uid;
//         }
        
//     }
// }

}

?>
<?php 


$sql1 = "SELECT * FROM project";

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
h2{
    text-align:center;
}
button{
    border:none;
}
#b{
    background:none;
}
.styled-table {
    margin: 25px 0;
    font-size: 1.2em;
    font-family: sans-serif;
    min-width: 1200px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
    border-collapse: separate;
    border-spacing: 0 3px;
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

       

        </tr>
   

    </thead>

    <tbody> 

        <?php

            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_assoc()) {
                    $pid = $row1['pid'];
                    $uidpd = "SELECT * from project_detail where `pid` = $pid ";
                    $resUPD = $conn->query($uidpd);
                    // $pd = "SELECT * from project_detail where `pid` = $pid ";
                    // $resPD = $conn->query($pd);
        ?> 
                    <tr>

                    
                    <td><?php echo $row1['pid']; ?></td>

                    <td><button id="b" class="b<?php echo$i; ?>"><?php echo $row1['ptitle']; ?></button></td>

                    <td><?php echo $row1['startDate']; ?></td>

                    <td><?php echo $row1['endDate']; ?></td>

                    
                    
<?php
                    
?>
                    

                     </tr>

                     <tr>
                     <th class="re<?php echo$i; ?>" style="display:none;">Description</th>
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $row1['description'];?></td>
                     </tr>
                     <tr><th class="re<?php echo$i; ?>" style="display:none;">Project Manager</th>
                     <th class="re<?php echo$i; ?>" style="display:none;">Employees</th></tr>
                     <tr>
                     <?php
                        

                    
                    if ($resUPD->num_rows > 0) {
                        $temp = TRUE;
                        while ($uprow = $resUPD->fetch_assoc()) {
                           
                            $id = $uprow['uid'];
                            $user = $conn->query("SELECT * from `user_detail` where `uid`= '".$id."'");
                            $uname = '';
                            while ($u = $user->fetch_assoc()) {
                                $uname = $u['user_name'];
                            }
                        ?>
                        
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php if($temp){echo $uprow['uid']."  (".$uname.")";$temp=FALSE;echo "</td><td class=\"re".$i."\" style=\"display:none;\"></td></tr>";continue;}?></td>
                            <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $uprow['uid']."  (".$uname.")";?>
                        </tr> 
                        
                    <?php
                        }
                    }
                    ?>
                     
                   
                   
                        
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
    <a id="bn" class="btn btn-info" href="project.php?un=<?php echo $user_name ?>">Back</a>
</body>

</html>
