<?php
include "dbconnect.php";
session_start();

if (!isset($_SESSION['id']) || !isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_POST["send"]) && isset($_GET['user'])) {
    $message = trim($_POST["message"]);

    if ($message !== "") {
        $sender_id = $_SESSION['id'];
        $sender_name = $_SESSION['username'];   
        $receiverid = (int) $_GET['user'];

        $query = "INSERT INTO `messages` (`user_id`, `receiver_id`, `sender`, `message`) VALUES ('$sender_id','$receiverid','$sender_name','$message')";
        $exe = mysqli_query($conn, $query);


        if (!$exe) {
            echo "<script>alert('Failed to send message'); window.location.href='index.php';</script>";
        }
        header("Location: index.php?user=$receiverid");
        exit();
    }
}
?>