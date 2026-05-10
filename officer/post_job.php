<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'officer'){
    header("Location: ../login.html");
    exit();
}

$companies = mysqli_query($conn, "SELECT * FROM companies");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $company_id = $_POST['company_id'];
    $title = $_POST['title'];
    $last_date = $_POST['last_date'];
    $cgpa = $_POST['cgpa'];

    mysqli_query($conn, "INSERT INTO jobs(company_id, title, last_date, eligibility_cgpa)
    VALUES('$company_id', '$title', '$last_date', '$cgpa')");

    echo "Job Posted Successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Job</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>Post Job</h2>

        <form method="POST">
            Company:
            <select name="company_id">
                <?php while($row = mysqli_fetch_assoc($companies)){ ?>
                    <option value="<?= $row['id']; ?>">
                        <?= $row['name']; ?>
                    </option>
                <?php } ?>
            </select><br>

            Job Title: <input type="text" name="title"><br>
            Last Date: <input type="date" name="last_date"><br>
            Eligibility CGPA: <input type="number" step="0.01" name="cgpa"><br>

            <button type="submit" class="btn">Post Job</button>
        </form>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>