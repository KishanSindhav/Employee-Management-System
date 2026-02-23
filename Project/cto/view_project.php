<?php

include "config.php";

$i=1;




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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>

#bn{
  position: absolute;
  top:10px;
  left:10%;
font-weight: bold;
}
h2{
    text-align:center;
}
button{
    border:none;
}
button:hover{
    color:#009879;  
}
#b{
    background:none;
}
tr:hover {
   color:#009879;
    font-weight: bold;
}
</style>
</head>

<body style="background-color: aliceblue ;">

    <div class="container">
<br><br>
        <h2>Project</h2>

<br><br>
<table class="table table-striped " >

    <thead>

        <tr  class="table-dark">

        <th scope="col">ID</th>

        <th scope="col"> Project Title</th>

        <th scope="col">Starting Date</th>

        <th scope="col">Ending Date</th>

       

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

                    
                    <td  style=" font-weight: bold;"><?php echo $row1['pid']; ?></td>

                    <td  style=" font-weight: bold;"><button  style=" font-weight: bold;" id="b" class="b<?php echo$i; ?>"><?php echo $row1['ptitle']; ?></button></td>

                    <td  style=" font-weight: bold;"><?php $d=$row1['startDate'];$d1=date("d-m-Y",strtotime($d));echo $d1;?></td>

                    <td  style=" font-weight: bold;"><?php $d2=$row1['endDate'];$d3=date("d-m-Y",strtotime($d2));echo $d3; ?></td>

                    
                    
<?php
                    
?>
                    

                     </tr>

                     <tr>
                     <th class="re<?php echo$i; ?>" style="display:none;">Description</th>
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $row1['description'];?></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"></td>
                     </tr>
                     <tr><th class="re<?php echo$i; ?>" style="display:none;">Project Manager</th>
                     <th class="re<?php echo$i; ?>" style="display:none;">Employees</th>
                     <td class="re<?php echo$i; ?>" style="display:none;"></td><td class="re<?php echo$i; ?>" style="display:none;"></td>
                    </tr>
                     
                     <tr>
                     <?php
                        

                    
                    if ($resUPD->num_rows > 0) {
                        $temp = TRUE;
                        while ($uprow = $resUPD->fetch_assoc()) {
                           
                            $id = $uprow['uid'];
                            $user = $conn->query("SELECT * from `user_detail` where `uid`= '".$id."'");
                            $uname = '';
                            while ($u = $user->fetch_assoc()) {
                                $fn=$u['first_name'];
                                $ln=$u['last_name'];
                            }
                        ?>
                        
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php if($temp){echo $fn.' '.$ln;$temp=FALSE;echo "</td><td class=\"re".$i."\" style=\"display:none;\"></td><td class=\"re".$i."\" style=\"display:none;\"></td><td class=\"re".$i."\" style=\"display:none;\"></td></tr>";continue;}?></td>
                            <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $fn.' '.$ln;?>
                            <td class="re<?php echo$i; ?>" style="display:none;"></td><td class="re<?php echo$i; ?>" style="display:none;"></td>
                        </tr> 
                        
                    <?php
                        }
                    }
                    ?>
                     
                   
                   
                        
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

    </div> 
    <a id="bn" class="btn btn-secondary " href="project.php">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
 
</body>

</html>
