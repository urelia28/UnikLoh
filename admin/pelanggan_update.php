<?php 
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$hp = $_POST['hp'];
$alamat = $_POST['alt'];

// update data
mysqli_query($koneksi,"update customers set name='$nama', email='$email', phone='$hp', address='$alamat' where id_user='$id'");

// mengalihkan halaman kembali ke halaman pelanggan
header("location:pelanggan.php");
?>