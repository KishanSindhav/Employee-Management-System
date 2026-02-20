<?php

include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}

?>
<?php 

include "config.php";

$sql = "SELECT * FROM user_detail where `role`=1";
$sql1 = "SELECT * FROM user_detail where `role`=2";
$result = $conn->query($sql);
$result1 = $conn->query($sql1);

?>

<!DOCTYPE html>

<html>

<head>

    <title>View Page</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

</head>
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
.chat{
    margin:0px 145px;
    
}
button, input, select, textarea {
    font-family: inherit;
    font-size: 25px;
    line-height: inherit;
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
#sub{
    height: 36px;
    width: 80px;
    margin: 1px 20px;
}

</style>
<body style="background-color: 	#FDF5E6 ;">
<div class="container">

<h2>Managers</h2>


<table class="styled-table" style="background-color:#FAEBD7;">

<thead>

<tr>

<th> ID</th>

<th>User Name</th>

<th>First Name</th>

<th>Last Name</th>

<th>Email</th>

<th>Address</th>

<th>Communicate</th>
<!-- 
<th>Delete</th> -->

</tr>

</thead>

<tbody> 

<?php

    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

?>

            <tr>

            <td><?php echo $row['uid']; ?></td>

            <td><?php echo $row['user_name']; ?></td>

            <td><?php echo $row['first_name']; ?></td>

            <td><?php echo $row['last_name']; ?></td>

            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['address']; ?></td>


            <td> <a class="btn btn-info" href="http://localhost/final_project/communicate_cto.php?uid=<?php echo $row['uid']?>&me_un=CTO2023">Communicate</a></td>

            <!-- <td> <a class="btn btn-danger" href="delete_user.php?un=<?php echo $row['user_name'];?>">Delete</a></td> -->
            </tr>                       

<?php       }

    }

?>                

</tbody>

</table>

</div> 
<br><br><br>

    <div class="container">

        <h2>Employees</h2>


<table class="styled-table" style="background-color:#FAEBD7;">

    <thead>

        <tr>

        <th> ID</th>

        <th>User Name</th>

        <th>First Name</th>

        <th>Last Name</th>

        <th>Email</th>

        <th>Address</th>

        <!-- <th>Delete</th> -->

        <!-- <th>Communicate</th> -->

    </tr>

    </thead>

    <tbody> 

        <?php

            if ($result1->num_rows > 0) {

                while ($row = $result1->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['uid']; ?></td>

                    <td><?php echo $row['user_name']; ?></td>

                    <td><?php echo $row['first_name']; ?></td>

                    <td><?php echo $row['last_name']; ?></td>

                    <td><?php echo $row['email']; ?></td>

                    <td><?php echo $row['address']; ?></td>

                    <!-- <td> <a class="btn btn-danger" href="delete_user.php?un=<?php echo $row['user_name'];?>">Delete</a></td> -->
                    <!-- <td> <a class="btn btn-info" href="http://localhost/final_project/communicate.php?un=<?php echo $user_name?>&uid=<?php echo $row['uid']; ?>">Communicate</a></td> -->
                    </tr>                       

        <?php       }

            }

        ?>                

    </tbody>

</table>

    </div> 
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
            <option size="200px" value="<?php echo $row['user_name'] ?>" name="man"><?php echo $row['user_name'] ?></option>
           
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
            <option value="<?php echo $row1['user_name'] ?>" name="emp"><?php echo $row1['user_name'] ?></option>
           
            <?php
                }
            }
            ?>
            </select>
            
            <input id="sub" class="btn btn-info"  type="submit" name="submit">
    </form>
    </div>
    <a id="bn" class="btn btn-info" href="index.php?un=CTO2023">Back</a>

</body>

</html>
