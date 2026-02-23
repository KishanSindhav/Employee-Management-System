<?php

$servername = "localhost";

$username = "root"; 

$password = ""; 

$dbname = "emp_management"; 

$connPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

}
?> 