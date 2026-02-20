<?php 

include "config.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `temp_notification` WHERE `id`='$id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";
	header("Location: pending_news.php?un=CTO2023");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>