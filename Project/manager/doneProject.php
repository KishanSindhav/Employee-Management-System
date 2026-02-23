<?php

include "config.php";

if(isset($_GET['pid']))
{
    
    $pid = $_GET['pid'];

    $pDone = $conn->query("UPDATE `project_detail` set `completedflag`=1 , `completedDate` = now() where `pid`= '".$pid."'");
    $availDone = $conn->query("UPDATE `avail` set `avail_flag`=0,`pid`=NULL where `pid`= '".$pid."'");

    if($pDone && $availDone)
    {
        header("Location: view_project.php");
    }
}

?>