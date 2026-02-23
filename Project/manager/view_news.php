<?php

include "config.php";

session_start();

$i=1;

if(isset($_SESSION['uemail'])) {

$user_name = $_SESSION['uemail'];

}

?>
<?php 

include "config.php";

$sql = "SELECT * FROM notification";

$result = $conn->query($sql);

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
  color:#ffffff;
font-weight: bold;
}
#bn1{
  position: absolute;
  top:65px;
  left:10%;
  color:#ffffff;
font-weight: bold;
}
#b{
    background:none;
}
h1{
    text-align:center;
}
button{
    border:none;
}
.table {

    border-collapse: collapse;
    margin: 25px 0;
    font-size: 1.2em;
    font-family: sans-serif;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.table th,
.table td {
    padding: 12px 15px;
}
.table tbody tr {
    border-bottom: 1px solid #dddddd;
}


.table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}
tr:hover {

    font-weight: bold;
}
#b:hover {
   color:#009879;
    font-weight: bold;
}

</style>
</head>

<body style="background-color: 	aliceblue ;">

    <div class="container">

        <h1>Notification</h1>
<a id="bn1" class="btn btn-secondary" href="news.php">Insert</a>
<br><br>

<table class="table table-striped">

    <thead>

        <tr class="table-dark">

        <th>ID</th>

        <th>Title</th>

        <th>Date</th>

        </tr>
   

    </thead>

    <tbody> 

        <?php

            if ($result->num_rows > 0) {

                while ($row = $result->fetch_assoc()) {

        ?>

                    <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><button class="b<?php echo$i; ?>"><?php echo $row['title']; ?></button></td>

                     <td><?php $d=$row['time'];$d1=date("d-m-Y H:i:s",strtotime($d));echo $d1;?></td>

                     </tr>

                     <tr>
                     <td class="re<?php echo$i; ?>" style="display:none;"></td>
                        <td class="re<?php echo$i; ?>" style="display:none;"><?php echo $row['content'];?></td>
                     </tr>

                     
                    <!-- <td> <a class="btn btn-info" href="update_user.php?id=<?php echo $row['empid'];?>">update</a></td>
                   
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
    <a id="bn" class="btn btn-secondary" href="news.php">Back</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 

</body>

</html>
