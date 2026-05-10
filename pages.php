<?php
if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    echo "Access Denied";
    exit();
}

$report = mysqli_query($conn, "
    SELECT users.name, companies.name AS company_name
    FROM applications
    JOIN students ON applications.student_id = students.id
    JOIN users ON students.user_id = users.id
    JOIN jobs ON applications.job_id = jobs.id
    JOIN companies ON jobs.company_id = companies.id
    WHERE applications.status='selected'
");

echo "<h2>Placement Report</h2>";
while($row = mysqli_fetch_assoc($report)){
    echo $row['name'] . " - " . $row['company_name'] . "<br>";
}
?>