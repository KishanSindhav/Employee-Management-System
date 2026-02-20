<?php

include "config.php";

if(isset($_GET['tid']))
{
    $id = $_GET['tid'];

    $un = $_GET['un'];

    $dn = $conn->query("UPDATE `task` set `done_flag`=1 where `id`= '".$id."'");

    if($dn)
    {
        header("Location: view_project.php?un=".$un);
    }
}

?>