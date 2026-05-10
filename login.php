<?php
session_start();
include 'db.php';

if($_SERVER["REQUEST_METHOD"] != "POST"){
    header("Location: login.html");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

$user = mysqli_fetch_assoc($result);

if($user && password_verify($password, $user['password'])){

    // Admin should always login
    if($user['role'] != 'admin' && $user['status'] != 'approved'){
        echo "Account not approved by Admin.";
        exit();
    }

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];

    if($user['role'] == 'student'){
        header("Location: student/dashboard.php");
    }
    elseif($user['role'] == 'officer'){
        header("Location: officer/dashboard.php");
    }
    elseif($user['role'] == 'admin'){
        header("Location: admin/dashboard.php");
    }

    exit();
}
else{
    echo "Invalid Credentials";
}
if($user['role'] != 'admin'){
    if($user['status'] == 'pending'){
        echo "Your account is pending approval.";
        exit();
    }
    if($user['status'] == 'rejected'){
        echo "Your account has been rejected by Admin.";
        exit();
    }
}