<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "
    UPDATE users 
    SET status='$status' 
    WHERE id='$id'
");

// Set notification message
$_SESSION['message'] = "User status updated to " . ucfirst($status) . " successfully.";

header("Location: approve_users.php");
exit();
?>