<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'officer'){
    header("Location: ../login.html");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST['name'];
    $hr = $_POST['hr'];
    $package = $_POST['package'];
    $cgpa = $_POST['cgpa'];

    mysqli_query($conn, "INSERT INTO companies(name, hr_name, package, eligibility_cgpa)
    VALUES('$name', '$hr', '$package', '$cgpa')");

    echo "Company Added Successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Company</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>Add Company</h2>

        <form method="POST">
            Company Name: <input type="text" name="name"><br>
            HR Name: <input type="text" name="hr"><br>
            Package: <input type="text" name="package"><br>
            Eligibility CGPA: <input type="number" step="0.01" name="cgpa"><br>
            <button type="submit" class="btn">Add Company</button>
        </form>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>