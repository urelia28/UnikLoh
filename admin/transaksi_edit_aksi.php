<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $transaction_id = $_POST['transaction_id'];
    $customers_id = $_POST['customers_id'];
    $date = $_POST['date'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    // Update data transaksi
    $query = "UPDATE transactions SET customers_id = '$customers_id', date = '$date', total_amount = '$total_amount', status = '$status' WHERE id = '$transaction_id'";
    
    if (mysqli_query($koneksi, $query)) {
        // Hapus detail produk yang ada
        mysqli_query($koneksi, "DELETE FROM transaction_items WHERE transaction_id = '$transaction_id'");

        // Insert detail produk yang baru
        foreach ($_POST['products'] as $product) {
            if (isset($product['name']) && !empty($product['name'])) {
                $product_name = $product['name'];
                $quantity = $product['quantity'];
                $price = $product['price'];

                $item_query = "INSERT INTO transaction_items (transaction_id, product_name, quantity, price) VALUES ('$transaction_id', '$product_name', '$quantity', '$price')";
                mysqli_query($koneksi, $item_query);
            }
        }

        // Redirect ke halaman transaksi dengan pesan sukses
        echo "<script>alert('Transaksi berhasil diperbarui!'); window.location.href='transaksi.php';</script>";
    } else {
        // Redirect ke halaman edit transaksi dengan pesan error
        echo "<script>alert('Gagal memperbarui transaksi.'); window.location.href='transaksi_edit.php?id=$transaction_id';</script>";
    }
} else {
    // Jika bukan POST, redirect ke halaman edit transaksi
    header('Location: transaksi_edit.php?id=' . $_POST['transaction_id']);
}
?>