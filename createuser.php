<?php
session_start();

// Periksa apakah admin sudah login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Proses form pembuatan user baru
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil nilai yang di-submit dari form
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Validasi username
    if(empty($username)){
        $username_err = "Mohon masukkan username.";
    } elseif(strlen($username) < 4){
        $username_err = "Username minimal terdiri dari 4 karakter.";
    } else{
        // Query untuk memeriksa apakah username sudah ada
        // Anda perlu mengganti ini dengan kode SQL yang sesuai dengan struktur database Anda
        // $sql = "SELECT id FROM users WHERE username = ?";
        // if($stmt = mysqli_prepare($link, $sql)){
        //     mysqli_stmt_bind_param($stmt, "s", $param_username);
        //     $param_username = $username;
        //     if(mysqli_stmt_execute($stmt)){
        //         mysqli_stmt_store_result($stmt);
        //         if(mysqli_stmt_num_rows($stmt) == 1){
        //             $username_err = "Username sudah digunakan.";
        //         } else{
        //             $username = $username;
        //         }
        //     } else{
        //         echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        //     }
        //     mysqli_stmt_close($stmt);
        // }
    }

    // Validasi password
    if(empty($password)){
        $password_err = "Mohon masukkan password.";
    } elseif(strlen($password) < 6){
        $password_err = "Password minimal terdiri dari 6 karakter.";
    }

    // Validasi konfirmasi password
    if(empty($confirm_password)){
        $confirm_password_err = "Mohon konfirmasi password.";
    } else{
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password tidak cocok.";
        }
    }

    // Jika tidak ada error, jalankan query untuk menambahkan user baru ke database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){
        // Query untuk menambahkan user baru
        // Anda perlu mengganti ini dengan kode SQL yang sesuai dengan struktur database Anda
        // $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        // if($stmt = mysqli_prepare($link, $sql)){
        //     mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
        //     $param_username = $username;
        //     $param_password = password_hash($password, PASSWORD_DEFAULT);
        //     if(mysqli_stmt_execute($stmt)){
        //         // Redirect ke halaman login setelah berhasil membuat user baru
        //         header("location: login.php");
        //     } else{
        //         echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        //     }
        //     mysqli_stmt_close($stmt);
        // }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Buat User Baru</title>
</head>
<body>
    <h2>Buat User Baru</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>Username:</label>
            <input type="text" name="username" value="<?php echo $username; ?>">
            <span><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo $password; ?>">
            <span><?php echo $password_err; ?></span>
        </div>
        <div>
            <label>Konfirmasi Password:</label>
            <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
            <span><?php echo $confirm_password_err; ?></span>
        </div>
        <div>
            <input type="submit" value="Buat User">
        </div>
    </form>
    <br>
    <a href="admindashboard.php">Kembali ke Dashboard</a>
</body>
</html>
