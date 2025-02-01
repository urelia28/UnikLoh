<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar
include 'header.php'; // Header yang sudah ada

// Ambil ID transaksi dari URL
$transaction_id = $_GET['id'];

// Ambil data transaksi berdasarkan ID
$transaction_query = mysqli_query($koneksi, "SELECT * FROM transactions WHERE id = '$transaction_id'");
$transaction = mysqli_fetch_array($transaction_query);

// Ambil data pelanggan untuk dropdown
$customers = mysqli_query($koneksi, "SELECT * FROM customers");

// Ambil detail produk untuk transaksi ini
$items_query = mysqli_query($koneksi, "SELECT * FROM transaction_items WHERE transaction_id = '$transaction_id'");
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Edit Transaksi</h4>
        </div>
        <div class="panel-body">
            <form method="POST" action="transaksi_edit_aksi.php">
                <input type="hidden" name="transaction_id" value="<?php echo $transaction['id']; ?>">
                <div class="form-group">
                    <label for="customers_id">Pelanggan</label>
                    <select name="customers_id" id="customers_id" class="form-control" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php while ($customer = mysqli_fetch_array($customers)) { ?>
                            <option value="<?php echo $customer['id_user']; ?>" <?php echo ($customer['id_user'] == $transaction['customers_id']) ? 'selected' : ''; ?>>
                                <?php echo $customer['name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control" value="<?php echo $transaction['date']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="total_amount">Harga Total</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" value="<?php echo $transaction['total_amount']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="0" <?php echo ($transaction['status'] == "0") ? 'selected' : ''; ?>>PROSES</option>
                        <option value="1" <?php echo ($transaction['status'] == "1") ? 'selected' : ''; ?>>DIKIRIM</option>
                        <option value="2" <?php echo ($transaction['status'] == "2") ? 'selected' : ''; ?>>SELESAI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="products">Detail Produk</label>
                    <div id="product-list">
                        <?php while ($item = mysqli_fetch_array($items_query)) { ?>
                            <div class="product-item">
                                <input type="text" name="products[<?php echo $item['id']; ?>][name]" placeholder="Nama Produk" value="<?php echo $item['product_name']; ?>" required>
                                <input type="number" name="products[<?php echo $item['id']; ?>][quantity]" placeholder="Jumlah" value="<?php echo $item['quantity']; ?>" required>
                                <input type="number" name="products[<?php echo $item['id']; ?>][price]" placeholder="Harga" value="<?php echo $item['price']; ?>" required>
                                <button type="button" class="btn btn-danger">Hapus</button>
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <button type="button" class="btn btn-secondary" onclick="location.href='transaksi.php'">Kembali</button>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('product-list').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-product')) {
            e.target.parentElement.remove();
        }
    });
</script>

<style>
    .button-group {
        margin-top: 20px; 
        display: flex; 
        justify-content: space-between;
    }
    .product-item {
        margin-bottom: 20px; 
    }
</style>