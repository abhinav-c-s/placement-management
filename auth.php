<?php
session_start();
include 'db.php';

$message = "";

// REGISTER LOGIC
if(isset($_POST['register'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn, "
        INSERT INTO users(name,email,password,role)
        VALUES('$name','$email','$password','$role')
    ");

    $message = "Registration Successful! Wait for admin approval.";
}

// LOGIN LOGIC
if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password,$user['password'])){

        if($user['role'] != 'admin'){
            if($user['status'] == 'pending'){
                $message = "Account pending approval.";
            }
            elseif($user['status'] == 'rejected'){
                $message = "Account rejected by Admin.";
            }
            else{
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
            }
        }
        else{
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];
        }

        if(isset($_SESSION['role'])){
            if($user['role'] == 'student'){
                header("Location: student/dashboard.php");
            }
            elseif($user['role'] == 'officer'){
                header("Location: officer/dashboard.php");
            }
            elseif($user['role'] == 'admin'){
                header("Location: admin/dashboard.php");
            }
            exit();
        }

    } else {
        $message = "Invalid Credentials.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Placement System</title>
<link rel="stylesheet" href="Assets/styles/ui.css">

<script>
function showRegister(){
    document.getElementById("loginForm").style.display="none";
    document.getElementById("registerForm").style.display="block";
}
function showLogin(){
    document.getElementById("registerForm").style.display="none";
    document.getElementById("loginForm").style.display="block";
}
</script>

</head>
<body>

<div class="auth-shell">
    <div class="card">
        <h1 class="brand">Placement Management</h1>
        <p class="muted">Secure portal for students, officers, and administrators.</p>

        <?php if($message != ""){ ?>
            <?php $messageClass = stripos($message, "successful") !== false ? "success" : "error"; ?>
            <p class="message <?= $messageClass; ?>"><?= $message; ?></p>
        <?php } ?>

        <div id="loginForm">
            <h2>Login</h2>
            <form method="POST">
                <div class="field">
                    <label for="loginEmail">Email</label>
                    <input id="loginEmail" type="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="field">
                    <label for="loginPassword">Password</label>
                    <input id="loginPassword" type="password" name="password" placeholder="Enter your password" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="login">Login</button>
            </form>

            <div class="toggle-row">
                <p class="muted">Need an account?</p>
                <button class="btn btn-muted btn-block" type="button" onclick="showRegister()">Create Account</button>
            </div>
        </div>

        <div id="registerForm" style="display:none;">
            <h2>Register</h2>
            <form method="POST">
                <div class="field">
                    <label for="registerName">Full Name</label>
                    <input id="registerName" type="text" name="name" placeholder="Your full name" required>
                </div>
                <div class="field">
                    <label for="registerEmail">Email</label>
                    <input id="registerEmail" type="email" name="email" placeholder="you@example.com" required>
                </div>
                <div class="field">
                    <label for="registerPassword">Password</label>
                    <input id="registerPassword" type="password" name="password" placeholder="Create a secure password" required>
                </div>
                <div class="field">
                    <label for="registerRole">Role</label>
                    <select id="registerRole" name="role" required>
                        <option value="">Select Role</option>
                        <option value="student">Student</option>
                        <option value="officer">Placement Officer</option>
                    </select>
                </div>
                <button class="btn btn-primary btn-block" type="submit" name="register">Register</button>
            </form>

            <div class="toggle-row">
                <p class="muted">Already have an account?</p>
                <button class="btn btn-muted btn-block" type="button" onclick="showLogin()">Back to Login</button>
            </div>
        </div>
    </div>
</div>
</body>
</html>
