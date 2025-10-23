<?php
session_start();
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $user = mysqli_fetch_assoc($result);
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    // Arahkan berdasarkan role
    if ($user['role'] == 'admin') {
        header("Location: admin_dashboard.php");
    } else if ($user['role'] == 'user'){
        header("Location: user_dashboard.php");
    } else
    {
        $_SESSION['error'] = "Role tidak dikenali!";
        header("Location: index.php");
    }
    exit;
} else {
    $_SESSION['error'] = "Username atau password salah!";
    header("Location: index.php");
    exit;
}
