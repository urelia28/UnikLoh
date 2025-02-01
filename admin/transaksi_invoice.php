<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar

// Ambil ID transaksi dari URL
$transaction_id = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$transaction_query = mysqli_query($koneksi, "SELECT transactions.*, customers.name FROM transactions JOIN customers ON transactions.customers_id = customers.id_user WHERE transactions.id = '$transaction_id'");
$transaction = mysqli_fetch_array($transaction_query);

// Ambil detail produk untuk transaksi ini
$items_query = mysqli_query($koneksi, "SELECT * FROM transaction_items WHERE transaction_id = '$transaction_id'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - <?php echo $transaction['id']; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .invoice {
            margin: 20px;
        }
        .invoice-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-table th, .invoice-table td {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>Invoice</h1>
            <p>Invoice ID: <?php echo $transaction['id']; ?></p>
            <p>Tanggal: <?php echo $transaction['date']; ?></p>
            <p>Pelanggan: <?php echo $transaction['name']; ?></p>
            <p>Status: <?php echo $transaction['status'] == "0" ? "PROSES" : ($transaction['status'] == "1" ? "DIKIRIM" : "SELESAI"); ?></p>
        </div>
        <table class="table table-bordered invoice-table">
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
        <div class="text-right">
            <h4>Total: Rp. <?php echo number_format($transaction['total_amount']); ?></h4>
        </div>
        <div class="text-center">
            <a href="transaksi_invoice_cetak.php?id=<?php echo $transaction['id']; ?>" class="btn btn-primary">Cetak Invoice</a>
            <button type="submit" class="btn btn-success"onclick="location.href='transaksi.php'">Kembali</button>
        </div>
    </div>
</body>
</html>