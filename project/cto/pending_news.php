<?php

include "config.php";

$i=1;

if(isset($_GET['un'])) {

$user_name = $_GET['un'];

}

?>
<?php 

include "config.php";

$sql = "SELECT * FROM temp_notification";

$result = $conn->query($sql);

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

</style>
</head>

<body style="background-color: 	#FDF5E6 ;">

    <div class="container">

        <h2>Notification</h2>


<table class="styled-table" style="background-color:#FAEBD7;">

    <thead>

        <tr>

        <th>ID</th>

        <th>Title</th>

        <th>Date</th>

        <th>Action</th>

        <th>Delete</th>

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

                     <td><?php echo $row['time']; ?></td>

                     <td> <a class="btn btn-info" href="confirm.php?id=<?php echo $row['id']; ?>&n=news">Confirn</a></td>

                     <td> <a class="btn btn-danger" href="delete_news.php?id=<?php echo $row['id'];?>">Delete</a></td>

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
    <a id="bn" class="btn btn-info" href="index.php?un=CTO2023">Back</a>
</body>

</html>
