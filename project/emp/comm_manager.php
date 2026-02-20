<?php

include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}

?>
<?php 

include "config.php";

$sql = "SELECT * FROM user_detail where `role`=1";

$result = $conn->query($sql);

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
</style>
<body style="background-color: 	#FDF5E6 ;">

    <div class="container">

        <h2>Managers</h2>


<table class="styled-table" style="background-color:#FAEBD7;">

    <thead>

        <tr>

        <th>User ID</th>

        <th>User Name</th>

        <th>Communicate</th>

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

                    <td> <a class="btn btn-info" href="http://localhost/final_project/communicate.php?un=<?php echo $user_name?>&uid=<?php echo $row['uid']; ?>">Communicate</a></td>
                    </tr>                       

        <?php       }

            }

        ?>                

    </tbody>

</table>

    </div> 

    <a id="bn" class="btn btn-info" href="index.php?un=<?php echo $user_name ?>">Back</a>

</body>

</html>
