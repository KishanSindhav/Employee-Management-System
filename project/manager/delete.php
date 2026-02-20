<?php 

include "config.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `feedback` WHERE `id`='$id'";

     $result = $conn->query($sql);

     if ($result == TRUE) {

        echo "Record deleted successfully.";
	header("Location: view.php");

    }else{

        echo "Error:" . $sql . "<br>" . $conn->error;

    }

} 

?>
