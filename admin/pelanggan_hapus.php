<?php 
// menghubungkan koneksi
include '../koneksi.php';

// menangkap data id yang dikirim dari url
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Jika parameter `confirm` diterima dari URL
    if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
        // menghapus pelanggan
        mysqli_query($koneksi, "DELETE FROM customers WHERE id_user='$id'");

        // alihkan halaman ke halaman pelanggan
        header("Location: pelanggan.php");
    } else {
        echo "<script>
        if (confirm('Yakin ingin menghapus data ini?')) {
            window.location.href = 'pelanggan_hapus.php?id=$id&confirm=yes';
        } else {
            window.location.href = 'pelanggan.php';
        }
        </script>";
    }
} else {
    // Jika `id` tidak ada di URL, kembali ke halaman pelanggan
    header("Location: pelanggan.php");
}
?>
