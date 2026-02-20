<?php 

include "config.php";

    if (isset($_POST['update'])) {

        $uid = $_POST['uid'];

        $user = $_POST['un'];

        $first_name = $_POST['firstName'];
    
        $last_name = $_POST['lastName'];
    
        $email = $_POST['email'];
    
        $address = $_POST['address'];

     $sql = "UPDATE `user_detail` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`address`='$address' WHERE `uid`='$uid'"; 

        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";
		header("Location: user_detail.php?un=".$user);

        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }

    } 

if (isset($_GET['un'])) {

    $user_name = $_GET['un']; 

    $sql = "SELECT * FROM `user_detail` WHERE `user_name`='$user_name'";

    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {

            $user_name = $row['user_name'];

            $uid = $row['uid'];

            $first_name = $row['first_name'];  

            $last_name = $row['last_name'];  
        
            $email = $row['email'];  

            $address = $row['address']; 
    
        } 

    ?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
h2,fieldset,td,th,input{
text-align:center;

}
form,table{
margin-left:auto;
margin-right:auto;
}
.styled-table {
    border-collapse: collapse;
    /* margin: 25px 0; */
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
    
        <h2>User Update Form</h2>
<table  class="styled-table" style="background-color:#FAEBD7;">
      <center>  <form action="" method="post" >

          <fieldset>

            <legend>Personal information:</legend>
            <br><br>
            <tr>
            <th>
            <label for="name"> First name : </label> </th>
<td>
            <input type="text" name="firstName" value="<?php echo $first_name; ?>">
            <input type="hidden" name="un" value="<?php echo $user_name; ?>">
            <input type="hidden" name="uid" value="<?php echo $uid; ?>"></td>
            </tr>
            
<tr>
<th>
            <label for="name"> Last name : </label> </th>
<td>
            <input type="text" name="lastName" value="<?php echo $last_name; ?>"></td>

            </tr>
<tr>
<th>
            <label for="name"> Email :  </label> </th>
<td>            <input type="email" name="email" value="<?php echo $email; ?>"></td>


            </tr>
<tr>
<th>
            <label for="name"> Address : </label> </th>

<td>        <input type="text" name="address" value="<?php echo $address; ?>"></td> 
            </tr>
          <tr>
<td>
            <input class="btn btn-info" type="submit" value="Update" name="update"></td>
            </tr>
          </fieldset>

        </form> 
        </center>
        </table>
        </body>

        </html> 

    <?php

    } else{ 

        header('Location: view_user.php');

    } 

} 

?> 
