<?php
session_start();

// Periksa apakah admin sudah login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}

// Folder tempat menyimpan file yang diunggah
$target_dir = "uploads/";

// Jika folder tidak ada, buat folder
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Proses unggahan file
if(isset($_POST["submit"])) {
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Periksa jika file sudah ada
    if (file_exists($target_file)) {
        echo "Maaf, file sudah ada.";
        $uploadOk = 0;
    }

    // Periksa ukuran file
    if ($_FILES["fileToUpload"]["size"] > 10000000) { // 10MB
        echo "Maaf, ukuran file terlalu besar.";
        $uploadOk = 0;
    }

    // Izinkan hanya beberapa jenis file tertentu
    if($fileType != "pdf" && $fileType != "doc" && $fileType != "docx" && $fileType != "txt" ) {
        echo "Maaf, hanya file PDF, DOC, DOCX, atau TXT yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Jika tidak ada kesalahan, unggah file
    if ($uploadOk == 0) {
        echo "Maaf, file tidak diunggah.";
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "File ". basename( $_FILES["fileToUpload"]["name"]). " berhasil diunggah.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Unggah File Admin</title>
</head>
<body>
    <h2>Unggah File Admin</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Unggah File" name="submit">
    </form>
    <br>
    <a href="admindashboard.php">Kembali ke Dashboard</a>
</body>
</html>
