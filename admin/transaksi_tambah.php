<?php
include '../koneksi.php'; // Pastikan koneksi database sudah benar
include 'header.php'; // Header yang sudah ada

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

        echo "<script>alert('Transaksi berhasil ditambahkan!'); window.location.href='transaksi.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan transaksi.');</script>";
    }
}

// Ambil data pelanggan untuk dropdown
$customers = mysqli_query($koneksi, "SELECT * FROM customers");
?>

<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Tambah Transaksi Baru</h4>
        </div>
        <div class="panel-body">
            <form method="POST" action="">
                <div class="form-group">
                    <label for="customers_id">Pelanggan</label>
                    <select name="customers_id" id="customers_id" class="form-control" required>
                        <option value="">Pilih Pelanggan</option>
                        <?php while ($customer = mysqli_fetch_array($customers)) { ?>
                            <option value="<?php echo $customer['id_user']; ?>"><?php echo $customer['name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Tanggal</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="total_amount">Harga Total</label>
                    <input type="number" name="total_amount" id="total_amount" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="0">PROSES</option>
                        <option value="1">DIKIRIM</option>
                        <option value="2">SELESAI</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="products">Detail Produk</label>
                    <div id="product-list">
                        <div class="product-item">
                            <input type="text" name="products[0][name]" placeholder="Nama Produk" required>
                            <input type="number" name="products[0][quantity]" placeholder="Jumlah" required>
                            <input type="number" name="products[0][price]" placeholder="Harga" required>
                            <button type="button" class="remove-product btn btn-danger">Hapus</button>
                            <button type="button" id="add-product" class="btn btn-primary">Tambah Produk</button>
                        </div>
                    </div>
                </div>
                <div class="button-group">
                    <button type="submit" class="btn btn-success">Simpan Transaksi</button>
                    <button type="button" class="btn btn-secondary" onclick="location.href='transaksi.php'">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    let productIndex = 1;

    document.getElementById('add-product').addEventListener('click', function() {
        const productList = document.getElementById('product-list');
        const newProductItem = document.createElement('div');
        newProductItem.classList.add('product-item');
        newProductItem.innerHTML = `
            <input type="text" name="products[${productIndex}][name]" placeholder="Nama Produk" required>
            <input type="number" name="products[${productIndex}][quantity]" placeholder="Jumlah" required>
            <input type="number" name="products[${productIndex}][price]" placeholder="Harga" required>
            <button type="button" class="remove-product btn btn-danger btn-sm">Hapus</button>
        `;
        productList.appendChild(newProductItem);
        productIndex++;
    });

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