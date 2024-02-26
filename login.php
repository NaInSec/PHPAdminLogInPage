<?php
// Koneksi ke server MySQL
$servername = "nainsec.pro.net";
$username = "usermysql";
$password = "passwordmysql";
$dbname = "db_nainsec_utama";

$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Lakukan query untuk memeriksa apakah user ada dalam database
$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "success";
} else {
    echo "error";
}

$conn->close();
?>

