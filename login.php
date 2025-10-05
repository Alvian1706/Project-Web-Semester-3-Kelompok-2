<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $conn->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM user WHERE username='$username'");
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['username'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content{
            width: 900px;              
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,.3);
            display: flex;
            overflow: hidden;
            min-height: 450px;        
        }
        .company__info{
            background-color: #008080;
            color: #fff;
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2em;
        }
        .company__logo img{
            width: 80px;
            height: 80px;
            margin-bottom: 1em;
        }
        .login_form{
            flex: 1;
            background-color: #fff;
            padding: 2em;
        }
        .login_form h3{
            color: #008080;
            margin-bottom: 1.5em;
        }
        .form-control:focus{
            border-color: #008080;
            box-shadow: 0 0 5px rgba(0,128,128,.3);
        }
        .btn-primary{
            background-color: #008080;
            border-color: #008080;
        }
        .btn-primary:hover{
            background-color: #006666;
            border-color: #006666;
        }
        @media screen and (max-width: 640px){
            .main-content{
                flex-direction: column;
                width: 90%;
            }
            .company__info{
                display: none;
            }
        }
    </style>
</head>
<body>

<!-- Centering container -->
<div class="d-flex align-items-center justify-content-center min-vh-100">
    <div class="main-content">
        <div class="company__info text-center">
            <div class="company__logo">
                <!-- Logo daun -->
                <img src="https://cdn-icons-png.flaticon.com/512/765/765624.png" alt="Logo Daun">
            </div>
            <h4>Selamat Datang</h4>
        </div>
        <div class="login_form">
            <h3 class="text-center">Login</h3>
            <?php 
            if (!empty($_SESSION['success'])) {
                echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
                unset($_SESSION['success']);
            }
            if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; 
            ?>
            <form method="POST" action="login.php">
                <div class="mb-3">
                    <label>Username</label>
                    <input type="text" name="username" required class="form-control" placeholder="Masukkan username">
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" required class="form-control" placeholder="Masukkan password">
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>
            <p class="mt-3 text-center">Belum punya akun? <a href="register.php">Register</a></p>
        </div>
    </div>
</div>

</body>
</html>
