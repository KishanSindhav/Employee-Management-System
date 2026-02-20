<?php


include "config.php";



if(isset($_GET['un'])) {

    $user_name = $_GET['un']; 

    $sql = "SELECT * FROM `user_detail` WHERE `user_name`='$user_name'";

    $sql1 = "SELECT * FROM `empsalary` WHERE `user_name` = '$user_name'";

    $result = $conn->query($sql); 

    $result1 = $conn->query($sql1); 

    

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee</title>
    
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<style>
#bn{
  position: absolute;
  top:10px;
  left:0%;
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
#b{
        background-color: #009879;
  color:#ffffff;
font-weight: bold;      
}
</style>
</head>
<body style="background-color: 	#FDF5E6 ;">

  <?php 
  
    if($result -> num_rows > 0 ){

        while($row = $result -> fetch_assoc()  ){
  
  ?>

    <table class="styled-table" style="background-color:#FAEBD7;">
  <center><h2>User details</h2></center>
  <br><br>
  <thead>
   
  </thead>
  <tbody>
    <tr>
            <th scope="row">ID</th>
            <td><?php echo $row['uid'] ?></td>
    </tr>
    <tr>
            <th scope="row">User Name</th>
            <td><?php echo $row['user_name'] ?></td>
    </tr>
    <tr>
            <th scope="row">First Name</th>
            <td><?php echo $row['first_name'] ?></td>
    </tr>
    <tr>
            <th scope="row">Last Name</th>
            <td><?php echo $row['last_name'] ?></td>
    </tr>
    <tr>
            <th scope="row">E-mail</th>
            <td><?php echo $row['email'] ?></td>
    </tr>
    <tr>
            <th scope="row">Address</th>
            <td><?php echo $row['address'] ?></td>
    </tr>
    <!-- <tr>
            <th scope="row">Salary</th>
            <td><?php echo $row['salary'] ?></td>
    </tr> -->
    <tr>
            <th scope="row">Password </th>
            <td><?php echo $row['password'] ?></td>
    </tr>

    <!-- <?php

    while($row1 = $result1 -> fetch_assoc()  ){
  
    ?>
    <tr>
            <th scope="row">Salary </th>
            <td><?php echo $row1['gsalary'] ?></td>
            <td> <?php echo $row1['date'] ?></td>
    </tr>
    

   <?php

        }

    ?> -->
  </tbody>
</table>


        <a id="b" class="btn btn-info" href="update_user.php?un=<?php echo $row['user_name'];?>">Update</a>
                   
<?php 
        } 
    }
 ?>   
 <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>                
</body>
</html>