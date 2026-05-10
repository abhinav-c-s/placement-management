<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

// Get student CGPA
$student = mysqli_query($conn, "SELECT * FROM students WHERE user_id='$user_id'");
$student_data = mysqli_fetch_assoc($student);
$student_cgpa = $student_data['cgpa'];

// Get eligible jobs
$jobs = mysqli_query($conn, "
    SELECT jobs.*, companies.name AS company_name
    FROM jobs
    JOIN companies ON jobs.company_id = companies.id
    WHERE jobs.eligibility_cgpa <= '$student_cgpa'
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eligible Jobs</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>Eligible Jobs</h2>

        <table border="1">
        <tr>
            <th>Company</th>
            <th>Job Title</th>
            <th>Last Date</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($jobs)){ ?>
        <tr>
            <td><?= $row['company_name']; ?></td>
            <td><?= $row['title']; ?></td>
            <td><?= $row['last_date']; ?></td>
            <td>
                <a class="btn" href="apply.php?job_id=<?= $row['id']; ?>">Apply</a>
            </td>
        </tr>
        <?php } ?>

        </table>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>