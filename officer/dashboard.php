<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'officer'){
    header("Location: ../login.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Officer Dashboard</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <div class="topbar">
            <h1>Placement Officer Dashboard</h1>
            <a class="btn btn-muted" href="../logout.php">Logout</a>
        </div>
        <p class="muted">Manage recruiting partners and publish opportunities for students.</p>

        <div class="grid">
            <a class="nav-tile" href="add_company.php">
                <h3>Add Company</h3>
                <p>Register recruiting companies and details.</p>
            </a>
            <a class="nav-tile" href="post_job.php">
                <h3>Post Job</h3>
                <p>Create new job openings linked to companies.</p>
            </a>
        </div>
    </div>
</div>
</body>
</html>
