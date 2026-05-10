<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];
$job_id = $_GET['job_id'];

// Get student id from students table
$student = mysqli_query($conn, "SELECT id FROM students WHERE user_id='$user_id'");
$student_data = mysqli_fetch_assoc($student);
$student_id = $student_data['id'];

// Insert application
mysqli_query($conn, "
    INSERT INTO applications(job_id, student_id)
    VALUES('$job_id', '$student_id')
");
?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <?php echo "<h2>Applied Successfully!</h2>"; ?>
        <br>
        <a class="btn" href="view_jobs.php">Back to Jobs</a>
    </div>
</div>
</body>
</html>