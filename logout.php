<?php
session_start();

// Unset semua session
session_unset();

// Hancurkan session
session_destroy();

// Redirect ke halaman login
header("location: index.php");
exit;
?>
