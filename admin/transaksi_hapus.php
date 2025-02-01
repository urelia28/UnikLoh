<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar

// Ambil ID transaksi dari URL
$transaction_id = $_GET['id'];

// Hapus detail produk terkait transaksi ini
$delete_items_query = "DELETE FROM transaction_items WHERE transaction_id = '$transaction_id'";
mysqli_query($koneksi, $delete_items_query);

// Hapus transaksi dari tabel transactions
$delete_transaction_query = "DELETE FROM transactions WHERE id = '$transaction_id'";
if (mysqli_query($koneksi, $delete_transaction_query)) {
    // Redirect ke halaman transaksi dengan pesan sukses
    echo "<script>alert('Transaksi berhasil dihapus!'); window.location.href='transaksi.php';</script>";
} else {
    // Redirect ke halaman transaksi dengan pesan error
    echo "<script>alert('Gagal menghapus transaksi.'); window.location.href='transaksi.php';</script>";
}
?>