<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $customers_id = $_POST['customers_id'];
    $date = $_POST['date'];
    $total_amount = $_POST['total_amount'];
    $status = $_POST['status'];

    // Insert data ke tabel transactions
    $query = "INSERT INTO transactions (customers_id, date, total_amount, status) VALUES ('$customers_id', '$date', '$total_amount', '$status')";
    
    if (mysqli_query($koneksi, $query)) {
        $transaction_id = mysqli_insert_id($koneksi); // Ambil ID transaksi yang baru ditambahkan

        // Insert detail produk ke tabel transaction_items
        foreach ($_POST['products'] as $product) {
            $product_name = $product['name'];
            $quantity = $product['quantity'];
            $price = $product['price'];

            $item_query = "INSERT INTO transaction_items (transaction_id, product_name, quantity, price) VALUES ('$transaction_id', '$product_name', '$quantity', '$price')";
            mysqli_query($koneksi, $item_query);
        }

        // Redirect ke halaman transaksi dengan pesan sukses
        echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href='transaksi.php';</script>";
    } else {
        // Redirect ke halaman transaksi dengan pesan error
        echo "<script>alert('Gagal menambahkan transaksi.'); window.location.href='transaksi_tambah.php';</script>";
    }
} else {
    // Jika bukan POST, redirect ke halaman tambah transaksi
    header('Location: transaksi_tambah.php');
}
?>