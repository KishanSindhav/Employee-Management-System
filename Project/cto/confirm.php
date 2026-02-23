<?php

include "config.php";

if(isset($_GET['id'])){

    $id=$_GET['id'];
    
    if(isset($_GET['n']))
    {
        $sql = "SELECT * FROM temp_notification where `id`=$id";
        $result = $conn->query($sql);

        if($result->num_rows>0){

        while($row=$result->fetch_assoc())
        {
            $uid = $row['uid'];
            $title= $row['title'];
            $content= $row['content'];
            
        }
    }

        $sql1 = "INSERT INTO `notification`(`uid`,`title`,`content`,`time`) 
        VALUES  ('$uid','$title','$content',now())";

        $result1 = $conn->query($sql1);

        $sql2 = "DELETE FROM `temp_notification` WHERE `id`=$id";

        $result2 = $conn->query($sql2);


        echo $result2;
        header("Location: pending_news.php");
    }
    else if(isset($_GET['p']))
    {
        $sql = "SELECT * FROM temp_project where `pid`=$id";
        $result = $conn->query($sql);

        if($result->num_rows>0){

        while($row=$result->fetch_assoc())
        {
            $uid = $row['uid'];
            $title= $row['ptitle'];
            $desc= $row['description'];
            $date = $row['startDate'];
        }
    }

        $sql1 = "INSERT INTO `project`(`uid`,`ptitle`,`description`,`startDate`) 
        VALUES  ('$uid','$title','$desc','$date')";

        $result1 = $conn->query($sql1);

        $sql2 = "DELETE FROM `temp_project` WHERE `pid`=$id";

        $result2 = $conn->query($sql2);


        echo $result2;
        header("Location: pending_project.php");
    }
    else{

        $sql = "SELECT * FROM temp where `uid`=$id";
        $result = $conn->query($sql);

        while($row=$result->fetch_assoc())
        {
            $firstname= $row['first_name'];
            $lastname= $row['last_name'];
            $role= $row['role'];
            $email= $row['email'];
            $address= $row['address'];
            $password= $row['password'];
        }


      // 🔍 Check if email already exists
$checkEmail = $conn->query("SELECT * FROM user_detail WHERE email = '$email'");

if($checkEmail->num_rows > 0){
    
    echo "<script>
            alert('User with this email already exists!');
            window.location='pending_user.php';
          </script>";
    exit();

} else {

    // Insert new user
    $sql1 = "INSERT INTO user_detail
    (first_name,last_name,role,email,address,password)
    VALUES
    ('$firstname','$lastname','$role','$email','$address','$password')";

    $result1 = $conn->query($sql1);

    // Get inserted uid
    $uid = $conn->insert_id;

    // Insert into avail table
    $conn->query("INSERT INTO avail(uid) VALUES ('$uid')");

    // Delete from temp table
    $conn->query("DELETE FROM temp WHERE uid = $id");

    header("Location: pending_user.php");
    exit();
}
        
       
        
        $sql1 = "INSERT INTO `avail`(`uid`) VALUES ('$uid')";
        $availRes = $conn->query($sql1);
        

        $sql2 = "DELETE FROM `temp` WHERE `uid`=$id";

        $result2 = $conn->query($sql2);


        echo $result2;
        header("Location: pending_user.php");

}


}
?>