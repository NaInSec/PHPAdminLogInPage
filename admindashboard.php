<?php
session_start();

// Periksa apakah admin sudah login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
</head>
<body>
    <h2>Selamat datang, Admin!</h2>
    <p>Ini adalah halaman dashboard admin.</p>
    <a href="logout.php">Logout</a>
</body>
</html>
