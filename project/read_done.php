<?php

include "config.php";

if(isset($_GET['un'])) {

$user_name = $_GET['un'];
echo $user_name;
$id = $_GET['id'];

}

if($user_name=='HR')
{
    $sql = "UPDATE `comm_emp` SET `read_flag`= 1 where `id` = $id ";

    $result = $conn->query($sql);

    $conn->close();

    header("Location: http://localhost/final_project/comm_view.php?un=HR");
}

else
{
    $sql = "UPDATE `comm_hr` SET `read_flag`= 1 where `id` = $id ";

    $result = $conn->query($sql);

    $conn->close();

   header("Location: http://localhost/final_project/comm_view.php?un=".$user_name);
}



?>