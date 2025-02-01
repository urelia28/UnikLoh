<?php
session_start();

// Simpan pesan ke dalam sesi
$_SESSION['logout_message'] = "Anda telah berhasil logout.";

// Hancurkan sesi
session_destroy();

// Redirect ke halaman utama atau login dengan pesan
header("location:../index.php?pesan=logout");
exit();
?>
