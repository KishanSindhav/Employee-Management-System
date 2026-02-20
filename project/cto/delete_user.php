<?php 

include "config.php"; 

if (isset($_GET['un'])) {

    $user_name = $_GET['un'];

    $sql = "DELETE FROM `user_detail` WHERE `user_name`='$user_name'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";
	header("Location: view_user.php?un=CTO2023");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>