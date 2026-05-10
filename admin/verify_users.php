<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

$users = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE status='pending' 
    AND role IN ('student','officer')
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Users</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>Pending Users</h2>

        <table border="1">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($users)){ ?>
        <tr>
            <td><?= $row['name']; ?></td>
            <td><?= $row['email']; ?></td>
            <td><?= $row['role']; ?></td>
            <td>
                <a class="btn" href="approve_user.php?id=<?= $row['id']; ?>">Approve</a>
            </td>
        </tr>
        <?php } ?>

        </table>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>