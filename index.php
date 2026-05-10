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

        <p>Welcome to the Placement Management System.</p>
        <br>
        <a class="btn" href="login.html">Login</a>
        <a class="btn btn-muted" href="register.html">Register</a>

    </div>
</div>

</body>
</html>