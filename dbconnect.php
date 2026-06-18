<?php 

$host = "Localhost";
$username = "root";
$password = "";
$database = "simple_chat";
$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
    echo "<script> alert('failed to connect database')</script>";
}

?>