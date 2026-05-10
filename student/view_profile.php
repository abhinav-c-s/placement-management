<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get student profile
$result = mysqli_query($conn, "
    SELECT users.name, users.email, students.branch, students.cgpa, students.skills, students.contact
    FROM users
    JOIN students ON users.id = students.user_id
    WHERE users.id = '$user_id'
");

$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>My Profile</h2>

        <?php if($student){ ?>

        <p><strong>Name:</strong> <?= $student['name']; ?></p>
        <p><strong>Email:</strong> <?= $student['email']; ?></p>
        <p><strong>Branch:</strong> <?= $student['branch']; ?></p>
        <p><strong>CGPA:</strong> <?= $student['cgpa']; ?></p>
        <p><strong>Skills:</strong> <?= $student['skills']; ?></p>
        <p><strong>Contact:</strong> <?= $student['contact']; ?></p>

        <?php } else { ?>

        <p>No profile found. Please update your profile first.</p>

        <?php } ?>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>