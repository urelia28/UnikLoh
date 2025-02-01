<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data transactions</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Transaksi Produk</h5>
        </div>
        <div class="card-body">
            <a href="transaksi_tambah.php" class="btn btn-primary mb-3">Transaksi Baru</a>
            <table  class="table table-hover" id="table-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Tanggal</th>
                        <th>Pelanggan</th>
                        <th>Harga Total</th>
                        <th>Status</th>
                        <th>Gambar</th>
                        <th>Detail Produk</th>
                        <th width="20%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                include '../koneksi.php';

                // Menggunakan JOIN untuk menghubungkan tabel customers dan transactions
                $data = mysqli_query($koneksi, "SELECT transactions.*, customers.name, products.gambar 
                    FROM transactions 
                    LEFT JOIN customers ON transactions.customers_id = customers.id_user 
                    LEFT JOIN transaction_items ON transactions.id = transaction_items.transaction_id 
                    LEFT JOIN products ON transaction_items.product_name = products.name 
                    ORDER BY transactions.id DESC");
                    $no = 1;
                while($d = mysqli_fetch_array($data)){ ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>INVOICE-<?php echo $d['customers_id']; ?></td>
                        <td><?php echo $d['date']; ?></td>
                        <td><?php echo $d['name']; ?></td>
                        <td><?php echo "Rp. " . number_format($d['total_amount']) . " ,-"; ?></td>
                        <td>
                            <?php 
                            if($d['status'] == "0"){
                                echo "<span class='badge bg-warning text-dark'>PROSES</span>";
                            } elseif($d['status'] == "1"){
                                echo "<span class='badge bg-info text-dark'>DIKIRIM</span>";
                            } elseif($d['status'] == "2"){
                                echo "<span class='badge bg-success'>SELESAI</span>";
                            }
                            ?>
                            <td><?php echo "<img src='../img/$d[gambar]' width=100 height=100 >"; ?></td>	
                        </td>
                        <td>
                            <?php
                            // Ambil detail produk untuk transaksi ini
                            $items_query = mysqli_query($koneksi, "SELECT * FROM transaction_items WHERE transaction_id = '{$d['id']}'");
                            if (mysqli_num_rows($items_query) > 0) {
                                echo "<ul>";
                                while ($item = mysqli_fetch_array($items_query)) {
                                    echo "<li>{$item['product_name']} - Jumlah: {$item['quantity']} - Rp. " . number_format($item['price']) . "</li>";
                                }
                                echo "</ul>";
                            } else {
                                echo "Tidak ada produk.";
                            }
                            ?>
                        </td>
                        <td>
                            <a href="transaksi_invoice.php?id=<?php echo $d['id']; ?>" target="_blank" class="btn btn-warning btn-sm">Invoice</a>
                            <a href="transaksi_edit.php?id=<?php echo $d['id']; ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="transaksi_hapus.php?id=<?php echo $d['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#table-datatable').DataTable();
    });
</script>