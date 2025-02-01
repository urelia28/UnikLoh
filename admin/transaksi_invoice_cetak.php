<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar

// Ambil ID transaksi dari URL
$transaction_id = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$transaction_query = mysqli_query($koneksi, "SELECT transactions.*, customers.name FROM transactions JOIN customers ON transactions.customers_id = customers.id_user WHERE transactions.id = '$transaction_id'");
$transaction = mysqli_fetch_array($transaction_query);

// Ambil detail produk untuk transaksi ini
$items_query = mysqli_query($koneksi, "SELECT * FROM transaction_items WHERE transaction_id = '$transaction_id'");

// Set header untuk cetak
header("Content-type: application/vnd.ms-word");
header("Content-Disposition: attachment; filename=invoice_$transaction_id.doc");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice Cetak - <?php echo $transaction['id']; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Invoice</h1>
        <p>Invoice ID: <?php echo $transaction['id']; ?></p>
        <p>Tanggal: <?php echo $transaction['date']; ?></p>
        <p>Pelanggan: <?php echo $transaction['name']; ?></p>
        <p>Status: <?php echo $transaction['status'] == "0" ? "PROSES" : ($transaction['status'] == "1" ? "DIKIRIM" : "SELESAI"); ?></p>
    </div>
    <table class="invoice-table">
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Jumlah</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($item = mysqli_fetch_array($items_query)) { ?>
                <tr>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['quantity']; ?></td>
                    <td>Rp. <?php echo number_format($item['price']); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="total">
        <h4>Total: Rp. <?php echo number_format($transaction['total_amount']); ?></h4>
    </div>
</body>
</html>