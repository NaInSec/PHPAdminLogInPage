<?php
session_start();

// Set token CSRF saat login
if(!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Memeriksa apakah pengguna sudah login
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // Redirect ke halaman admin jika pengguna sudah login
    header("location: admindashboard.php");
    exit;
}

// Memeriksa apakah pengguna mengirimkan formulir login
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Memeriksa token CSRF
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Token CSRF tidak valid, tindakan ditolak
        die("Token CSRF tidak valid.");
    }

    // Validasi username dan password (contoh sederhana, silakan disesuaikan dengan logika autentikasi yang sesuai)
    $username = "admin";
    $password = "password";
    if($_POST["username"] === $username && $_POST["password"] === $password) {
        // Jika autentikasi berhasil, set session untuk menandai pengguna sudah login
        $_SESSION["loggedin"] = true;
        
        // Mengatur cookies dengan nama "user" dengan nilai username pengguna
        setcookie("user", $username, time() + 3600, "/");

        // Redirect ke halaman admin setelah login berhasil
        header("location: admindashboard.php");
    } else {
        // Autentikasi gagal, tampilkan pesan error
        $login_err = "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulir Login dengan Token CSRF</title>
</head>
<body>
    <h2>Formulir Login dengan Token CSRF</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <div>
            <label>Username:</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password">
        </div>
        <div>
            <input type="submit" value="Login">
        </div>
    </form>
    <?php if(isset($login_err)) { echo "<p>$login_err</p>"; } ?>
</body>
</html>
