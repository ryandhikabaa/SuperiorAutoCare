<?php

$user = "root";
$pass = "";
$host = "localhost";
$dbdb = "db_superior_auto_care";
    
$conn = new mysqli($host, $user, $pass, $dbdb);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

?>