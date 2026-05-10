<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'officer'){
    header("Location: ../login.html");
    exit();
}

$app_id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conn, "
    UPDATE applications
    SET status='$status'
    WHERE id='$app_id'
");

header("Location: view_applications.php");
exit();
?>