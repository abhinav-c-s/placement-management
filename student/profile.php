<?php
session_start();
include '../db.php';

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student'){
    header("Location: ../login.html");
    exit();
}

$user_id = $_SESSION['user_id'];

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $branch = $_POST['branch'];
    $cgpa = $_POST['cgpa'];
    $skills = $_POST['skills'];
    $contact = $_POST['contact'];

    // Check if profile already exists
    $check = mysqli_query($conn, "SELECT * FROM students WHERE user_id='$user_id'");

    if(mysqli_num_rows($check) > 0){
        // Update
        mysqli_query($conn, "UPDATE students 
            SET branch='$branch', cgpa='$cgpa', skills='$skills', contact='$contact'
            WHERE user_id='$user_id'");
    } else {
        // Insert
        mysqli_query($conn, "INSERT INTO students(user_id, branch, cgpa, skills, contact)
            VALUES('$user_id', '$branch', '$cgpa', '$skills', '$contact')");
    }

    echo "Profile Saved Successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="../Assets/styles/ui.css">
</head>
<body>
<div class="page">
    <div class="card">
        <h2>Update Profile</h2>

        <form method="POST">
            Branch: <input type="text" name="branch"><br>
            CGPA: <input type="number" step="0.01" name="cgpa"><br>
            Skills: <input type="text" name="skills"><br>
            Contact: <input type="text" name="contact"><br>
            <button type="submit" class="btn">Save</button>
        </form>

        <a class="btn btn-muted" href="dashboard.php" style="margin-top:20px;">Back</a>
    </div>
</div>
</body>
</html>