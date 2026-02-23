<?php 

include "config.php"; 

if (isset($_GET['id'])) {

    $uid = $_GET['id'];

    $sql = "DELETE FROM `temp` WHERE `uid`='$uid'";
    
     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";
	header("Location: pending_user.php");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>