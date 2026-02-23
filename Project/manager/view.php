s<?php

include "config.php";

session_start();
$result = false;
if(isset($_SESSION['uemail'])) {

$user_name = $_SESSION['uemail'];
if(isset($_GET['pid'])){
$pid = $_GET['pid'];



?>
<?php 

include "config.php";

$sql = "SELECT * FROM feedback where `pid`=$pid" ;

$result = $conn->query($sql);


}
}
?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<style>

#bn{
  position: absolute;
  top:10px;
  left:10%;
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
h1{
    text-align:center;
}


</style>
</head>

<body style="background-color:aliceblue;">
<br><br><br>
    <div class="container">

        <h1>Feedback</h1>

<br><br>
<table  class="table table-striped">

    <thead>

        <tr class="table-dark">

        <th>ID</th>

        <th>User ID</th>

        <th>Project ID</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Feedback</th>

        <th>Action</th>

    </tr>

    </thead>

    <tbody> 

        <?php
        if($result){

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo $row['uid']; ?></td>

                    <td><?php echo $row['pid']; ?></td>

                    <?php

                            $fl_sql = "SELECT * from `user_detail` where `uid` = '".$row['uid']."'";

                            $result1 = $conn->query($fl_sql);

                            while ($row1 = $result1->fetch_assoc()) {

                    ?>

                    <td><?php echo $row1['first_name']; ?></td>

                    <td><?php echo $row1['last_name']; ?></td>

                    <?php

                            }

                    ?>

                    <td><?php echo $row['feedback']; ?></td>

                
                   <td>
                    <a class="btn btn-danger" href="delete.php?id=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>                       

        <?php       }

            }

        }

        ?>                

    </tbody>

</table>

    </div> 
    <a id="bn" class="btn btn-secondary" href="view_project.php">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
   
</body>

</html>
