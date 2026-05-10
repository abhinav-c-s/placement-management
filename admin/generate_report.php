<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

// Fetch only selected students
$report = mysqli_query($conn, "
    SELECT users.name AS student_name,
           students.branch,
           students.cgpa,
           companies.name AS company_name,
           jobs.title
    FROM applications
    JOIN students ON applications.student_id = students.id
    JOIN users ON students.user_id = users.id
    JOIN jobs ON applications.job_id = jobs.id
    JOIN companies ON jobs.company_id = companies.id
    WHERE applications.status = 'selected'
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Report</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <div class="topbar">
            <h2>Placement Report</h2>
            <a class="btn btn-muted" href="dashboard.php">Back to Dashboard</a>
        </div>
        <p class="muted">Students with status marked as selected are listed below.</p>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>Student Name</th>
                    <th>Branch</th>
                    <th>CGPA</th>
                    <th>Company</th>
                    <th>Job Title</th>
                </tr>

                <?php while($row = mysqli_fetch_assoc($report)){ ?>
                <tr>
                    <td><?= $row['student_name']; ?></td>
                    <td><?= $row['branch']; ?></td>
                    <td><?= $row['cgpa']; ?></td>
                    <td><?= $row['company_name']; ?></td>
                    <td><?= $row['title']; ?></td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
