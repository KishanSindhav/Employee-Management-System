<?php 

include "config.php";

session_start();


    if (isset($_POST['update'])) {

        $uid = $_POST['uid'];

        $first_name = $_POST['firstName'];
    
        $last_name = $_POST['lastName'];
    
        $address = $_POST['address'];

        

     $sql = "UPDATE `user_detail` SET `first_name`='$first_name',`last_name`='$last_name',`address`='$address' WHERE `uid`='$uid'"; 

        $result = $conn->query($sql); 

        if ($result == TRUE) {

            echo "Record updated successfully.";
		header("Location: user_detail.php");

        }else{

            echo "Error:" . $sql . "<br>" . $conn->error;

        }

    } 
    if(isset($_POST['UpdatePhoto']))
{ 
    $uid = $_POST['uid'];
    $file = $_FILES['fileDoc'];


    if (!empty($file) && isset($file)) {
    
        $allowedTypes = ['image/jpeg','image/jpg', 'image/png'];
        if (!in_array($file['type'], $allowedTypes)) {
            echo "Only JPEG, and PNG are allowed.";
            exit();
        }
    
        $fileName = $uid.'_profile.jpg';
        $uploadsDir = '../profilePhoto/';
        if (!move_uploaded_file($file['tmp_name'], $uploadsDir.$fileName)) {
            echo "There was an error uploading the file.";
            exit();
        }
        $updateData = $conn->query("UPDATE `user_detail` set `pPAth` = '".$fileName."' where `uid`= '".$uid."'" );
        if($updateData){
        ?>
        <script>
            alert("Photo Updated successfully.");
            header('Location: update_user.php');
        </script>
        <?php
        }
        
        }
     
    
    }

if (isset($_SESSION['uemail'])) {

    $user_name = $_SESSION['uemail']; 

    $sql = "SELECT * FROM `user_detail` WHERE `email`='$user_name'";

    $result = $conn->query($sql); 

    if ($result->num_rows > 0) {        

        while ($row = $result->fetch_assoc()) {

            $uid = $row['uid'];

            $first_name = $row['first_name'];  

            $last_name = $row['last_name'];   

            $address = $row['address']; 

            $path = $row['pPAth'];
    
        } 

    ?>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<style>
h2,fieldset,td,th,input{
text-align:center;
}
form,table{
margin-left:auto;
margin-right:auto;
}
tr:hover {
   color:#009879;
    font-weight: bold;
}
#b{
  position: absolute;
  top:10px;
  left:10%;
font-weight: bold;
}
input[type=text], select, textarea {    
    width: 51%;
    padding: 10px;
    border: 1px solid rgb(70, 68, 68);
    border-radius: 10px;
    resize: vertical;   
  }       
       
  input[type=submit]:hover {    
    background-color: #45a049;    
  }    
      
th,td{
    padding:10px;
}

</style>

</head>
<body style="background-color: aliceblue ;">
<a id="b" class=" btn btn-secondary" href="user_detail.php">back</a>
<br><br> 
        <h2>User Update Form</h2>
        <div class="container">
<table  class="table table-striped" >
      <center>  <form action="" method="post" >

          <fieldset>

            <legend>Personal information:</legend>
            <br><br>
            <tr>
            <th>
            <label for="name"> First name : </label> </th>
<td>
            <input type="text" name="firstName" value="<?php echo $first_name; ?>">
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
            <label for="name"> Address : </label> </th>

<td>        <input type="text" name="address" value="<?php echo $address; ?>"></td> 
            </tr>
            
          <tr>
<td>
            <input class="btn btn-secondary" type="submit" value="Update" name="update"></td>
            <td></td>
            </tr>
          </fieldset>
          

        </form> 
        <tr>
            <form method="post" enctype="multipart/form-data">
            <th><label for="name"> Update Photo : </label></th>
                <td colspan="1" >
                <input type="file"  name="fileDoc"  id="formFile">
                <input type="hidden" id="uid" name="uid" value="<?php echo $uid ?>">
                
                <input type="submit" name="UpdatePhoto" value="Submit">

                </td>
                
                </form>
            </tr>
        </center>
        </table>


        
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script> 
 
        </body>

        </html> 

    <?php

    } else{ 

        header('Location: view_user.php');

    } 

} 

?> 
