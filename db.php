<?php
$servername = "abhinav-abhinavcschalackal-0524.b.aivencloud.com";
$username = "avnadmin";
$password = "AVNS_wjI-M0IVi6-Gn5W56uv";
$database = "defaultdb";
$port = 25934;

// Initialize connection with custom port
$conn = mysqli_connect($servername, $username, $password, $database, $port);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>