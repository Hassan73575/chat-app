<?php
session_start();
include "dbconnect.php";

// offline status update
$userId = (int)$_SESSION['id'];

mysqli_query($conn, "UPDATE users SET isonline = 0 WHERE id = $userId");

session_destroy();

header("Location: login.php");
exit();
?>