<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'officer'){
    header("Location: ../login.html");
    exit();
}

$applications = mysqli_query($conn, "
    SELECT applications.id,
           users.name AS student_name,
           jobs.title,
           companies.name AS company_name,
           applications.status
    FROM applications
    JOIN students ON applications.student_id = students.id
    JOIN users ON students.user_id = users.id
    JOIN jobs ON applications.job_id = jobs.id
    JOIN companies ON jobs.company_id = companies.id
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Applications</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>All Applications</h2>

        <table border="1">
        <tr>
            <th>Student</th>
            <th>Company</th>
            <th>Job</th>
            <th>Status</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($applications)){ ?>
        <tr>
            <td><?= $row['student_name']; ?></td>
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