<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$role = $_POST['role'];

$sql = "INSERT INTO users(name,email,password,role) 
        VALUES('$name','$email','$password','$role')";

if(mysqli_query($conn,$sql)){
    header("Location: login.html?registered=1");
    exit();
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
