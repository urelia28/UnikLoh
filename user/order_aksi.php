<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['customer_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total_amount = $quantity * $price;

    // Cek apakah pelanggan sudah ada
    $customer_check = mysqli_query($koneksi, "SELECT * FROM customers WHERE name = '$customer_name' AND email = '$email'");
    
    if (mysqli_num_rows($customer_check) > 0) {
        // Jika pelanggan sudah ada, ambil ID pelanggan
        $customer_data = mysqli_fetch_array($customer_check);
        $customer_id = $customer_data['id_user'];
    } else {
        // Jika pelanggan belum ada, tambahkan pelanggan baru
        $insert_customer = mysqli_query($koneksi, "INSERT INTO customers (name, email, phone, address) VALUES ('$customer_name', '$email', '$phone', '$address')");
        if ($insert_customer) {
            $customer_id = mysqli_insert_id($koneksi); // Ambil ID pelanggan yang baru ditambahkan
        } else {
            echo "<script>alert('Gagal menambahkan pelanggan.'); window.location.href='order.php';</script>";
            exit;
        }
    }

    // Insert into transactions table
    $insert_transaction = mysqli_query($koneksi, "INSERT INTO transactions (customers_id, total_amount, date, status) VALUES ('$customer_id', '$total_amount', NOW(), '0')");
    
    if ($insert_transaction) {
        $transaction_id = mysqli_insert_id($koneksi); // Get the last inserted transaction ID

        // Insert into transaction_items table
        $insert_item = mysqli_query($koneksi, "INSERT INTO transaction_items (transaction_id, product_name, quantity, price) VALUES ('$transaction_id', '$product_name', '$quantity', '$price')");

        if ($insert_item) {
            echo "<script>alert('Order berhasil dibuat!'); window.location.href='index.php';</script>";
        } else {
            echo "<script>alert('Gagal menambahkan item transaksi.'); window.location.href='order.php';</script>";
        }
    } else {
        echo "<script>alert('Gagal membuat transaksi.'); window.location.href='order.php';</script>";
    }
} else {
    echo "<script>alert('Metode permintaan tidak valid.'); window.location.href='order.php';</script>";
}
?>