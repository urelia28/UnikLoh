<?php
include '../koneksi.php';

// Menangkap data yang dikirim dari form
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$hp = mysqli_real_escape_string($koneksi, $_POST['hp']);
$alt = mysqli_real_escape_string($koneksi, $_POST['alt']);

// Input data ke tabel pelanggan
$query = "INSERT INTO customers (name, email, phone, address) 
          VALUES ('$nama', '$email', '$hp', '$alt')";

if (mysqli_query($koneksi, $query)) {
    // Redirect jika sukses
    header("Location: pelanggan.php");
} else {
    // Tampilkan pesan error jika gagal
    echo "Error: " . $query . "<br>" . mysqli_error($koneksi);
}

// Tutup koneksi
mysqli_close($koneksi);
?>
