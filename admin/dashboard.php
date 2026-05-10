<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <div class="topbar">
            <h1>Admin Dashboard</h1>
            <a class="btn btn-muted" href="../logout.php">Logout</a>
        </div>
        <p class="muted">Manage user approvals and track placement outcomes from one place.</p>

        <div class="grid">
            <a class="nav-tile" href="approve_users.php">
                <h3>Approve Users</h3>
                <p>Review student and officer registrations.</p>
            </a>
            <a class="nav-tile" href="generate_report.php">
                <h3>Placement Report</h3>
                <p>View selected students and company allocation.</p>
            </a>
        </div>
    </div>
</div>
</body>
</html>
