<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

$id = $_GET['id'];

mysqli_query($conn, "
    UPDATE users 
    SET status='approved' 
    WHERE id='$id'
");

header("Location: approve_users.php");
exit();
?>