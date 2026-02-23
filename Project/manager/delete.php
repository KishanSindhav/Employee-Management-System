<?php 

include "config.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // 🔹 First get pid before deleting
    $getPidQuery = $conn->query("SELECT pid FROM feedback WHERE id = '$id'");
    
    if($getPidQuery && $getPidQuery->num_rows > 0){
        $row = $getPidQuery->fetch_assoc();
        $pid = $row['pid'];
    } else {
        die("Invalid ID");
    }

    // 🔹 Now delete
    $sql = "DELETE FROM feedback WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result == TRUE) {

        // 🔹 Redirect WITH pid
        header("Location: view.php?pid=$pid");
        exit();

    } else {

        echo "Error: " . $conn->error;

    }

}
?>