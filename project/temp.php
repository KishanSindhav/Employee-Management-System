<?php

include "config.php";


$sql = "SELECT * FROM task ";

$result = $conn->query($sql);

print_r($result);
?>

