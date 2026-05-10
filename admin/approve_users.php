<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../login.html");
    exit();
}

$users = mysqli_query($conn, "
    SELECT * FROM users 
    WHERE role IN ('student','officer')
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Users</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <div class="topbar">
            <h2>Approve Students & Placement Officers</h2>
            <a class="btn btn-muted" href="dashboard.php">Back to Dashboard</a>
        </div>

        <?php if(isset($_SESSION['message'])){ ?>
            <p class="message success"><?= $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php } ?>

        <div class="table-wrap">
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php while($row = mysqli_fetch_assoc($users)){ ?>
                <tr>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= ucfirst($row['role']); ?></td>
                    <td>
                        <span class="badge badge-<?= $row['status']; ?>">
                            <?= $row['status']; ?>
                        </span>
                    </td>
                    <td class="action-links">
                        <?php if($row['status'] == 'pending'){ ?>
                            <a href="update_status.php?id=<?= $row['id']; ?>&status=approved">Approve</a>
                            <span class="sep">|</span>
                            <a href="update_status.php?id=<?= $row['id']; ?>&status=rejected">Reject</a>
                        <?php } elseif($row['status'] == 'approved'){ ?>
                            Approved
                        <?php } else { ?>
                            Rejected
                        <?php } ?>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>
</body>
</html>
