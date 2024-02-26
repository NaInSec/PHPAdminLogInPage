<?php
session_start();

// Periksa apakah admin sudah login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Proses form penghapusan data
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil ID data yang akan dihapus dari form
    $data_id = trim($_POST["data_id"]);

    // Lakukan query untuk menghapus data dari database
    // Anda perlu mengganti ini dengan kode SQL yang sesuai dengan struktur database Anda
    // $sql = "DELETE FROM data WHERE id = ?";
    // if($stmt = mysqli_prepare($link, $sql)){
    //     mysqli_stmt_bind_param($stmt, "i", $param_data_id);
    //     $param_data_id = $data_id;
    //     if(mysqli_stmt_execute($stmt)){
    //         // Data berhasil dihapus
    //         // Redirect atau tampilkan pesan sukses
    //     } else{
    //         echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
    //     }
    //     mysqli_stmt_close($stmt);
    // }

    // Contoh pesan sukses jika data berhasil dihapus
    echo "Data berhasil dihapus.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Hapus Data</title>
</head>
<body>
    <h2>Hapus Data</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div>
            <label>ID Data:</label>
            <input type="text" name="data_id">
        </div>
        <div>
            <input type="submit" value="Hapus Data">
        </div>
    </form>
    <br>
    <a href="admindashboard.php">Kembali ke Dashboard</a>
</body>
</html>
