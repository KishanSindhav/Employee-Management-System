<?php

include "config.php";

if(isset($_GET['tid']))
{
    $id = $_GET['tid'];
    $pid = $_GET['pid'];

    $tt = $conn->query("SELECT COUNT(done_flag) as doneCount from `task` where `done_flag` = '0'");
    $ttCount = mysqli_fetch_assoc($tt)["doneCount"];

    if($ttCount == 1)
    {
        $dn = $conn->query("UPDATE `task` set `done_flag`=1 where `id`= '".$id."'");
        $pDone = $conn->query("UPDATE `project_detail` set `completedflag`=1 , `completedDate` = now() where `pid`= '".$pid."'");
        $availDone = $conn->query("UPDATE `avail` set `avail_flag`=0,`pid`=NULL where `pid`= '".$pid."'");

    }
    else{
        $dn = $conn->query("UPDATE `task` set `done_flag`=1 where `id`= '".$id."'");

    }

    if($dn)
    {
        header("Location: view_project.php");
    }
}

?>