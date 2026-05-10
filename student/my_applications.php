<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get student id
$student = mysqli_query($conn, "SELECT id FROM students WHERE user_id='$user_id'");
$student_data = mysqli_fetch_assoc($student);
$student_id = $student_data['id'];

$applications = mysqli_query($conn, "
    SELECT jobs.title, companies.name AS company_name, applications.status
    FROM applications
    JOIN jobs ON applications.job_id = jobs.id
    JOIN companies ON jobs.company_id = companies.id
    WHERE applications.student_id = '$student_id'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Applications</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>My Applications</h2>

        <table border="1">
        <tr>
            <th>Company</th>
            <th>Job</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($applications)){ ?>
        <tr>
            <td><?= $row['company_name']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['status']; ?></td>
        </tr>
        <?php } ?>

        </table>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>