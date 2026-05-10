<?php
session_start();
include 'db.php';

$action = $_GET['action'] ?? 'home';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement System</title>
    <link rel="stylesheet" href="Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h1>Placement Management System</h1>

<?php
// ROUTING SYSTEM

if($action == 'register'){
    include 'pages/register.php';
}
elseif($action == 'login'){
    include 'pages/login.php';
}
elseif($action == 'dashboard'){
    include 'pages/dashboard.php';
}
elseif($action == 'profile'){
    include 'pages/profile.php';
}
elseif($action == 'report'){
    include 'pages/report.php';
}
else{
    echo "<a href='?action=login'>Login</a> | ";
    echo "<a href='?action=register'>Register</a>";
}
?>

    </div>
</div>

</body>
</html>