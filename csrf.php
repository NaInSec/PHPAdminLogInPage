<?php
session_start();

// Membuat dan menyimpan token CSRF pada saat login
if(!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Memeriksa token CSRF saat menerima data form
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if(!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        // Token CSRF tidak valid, tindakan ditolak
        die("Token CSRF tidak valid.");
    }
    // Token CSRF valid, lanjutkan dengan memproses data form
    // ...
}

// Menambahkan token CSRF pada form
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Contoh dengan Token CSRF</title>
</head>
<body>
    <h2>Form Contoh dengan Token CSRF</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
        <!-- Field-form lainnya -->
        <input type="submit" value="Submit">
    </form>
</body>
</html>
