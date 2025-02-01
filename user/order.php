<?php
include '../koneksi.php'; // Koneksi ke database

// Ambil daftar produk dari tabel 'products'
$query = "SELECT id, name, price FROM products";
$result = $koneksi->query($query);
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Poppins", sans-serif;
    }

    body {
        background-color: #f6f6f6;
        color: #5D87B1;
        line-height: 1.6;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .panel {
        margin: 20px 0;
    }

    .panel-heading {
        background-color: #305174;
        padding: 10px 20px;
        border-radius: 8px 8px 0 0;
        color: #fff;
    }

    .panel-heading h4 {
        margin: 0;
        font-size: 20px;
    }

    .panel-body {
        padding: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
        color: #333;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 2px solid #ccc;
        border-radius: 4px;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #305174;
        outline: none;
    }

    .btn {
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 4px;
        text-decoration: none;
        display: inline-block;
        text-align: center;
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .btn-primary {
        background-color: #305174;
        color: #fff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #003f63;
    }

    .btn-secondary {
        background-color: #ccc;
        color: #333;
        border: none;
    }

    .btn-secondary:hover {
        background-color: #999;
    }
</style>
<div class="container">
    <div class="panel">
        <div class="panel-heading">
            <h4>Form Order Produk</h4>
        </div>
        <div class="panel-body">
            <form action="order_aksi.php" method="POST">
                <div class="form-group">
                    <label for="customer_name">Nama Pelanggan</label>
                    <input type="text" name="customer_name" id="customer_name" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="address">Alamat</label>
                    <textarea name="address" id="address" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="product_name">Nama Produk</label>
                    <select name="product_name" id="product_name" class="form-control" required onchange="updatePrice()">
                        <option value="">-- Pilih Produk --</option>
                        <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <option value="<?= htmlspecialchars($row['name']) ?>" data-price="<?= $row['price'] ?>">
                                    <?= htmlspecialchars($row['name']) ?> - Rp <?= number_format($row['price'], 0, ',', '.') ?>
                                </option>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <option value="">Produk tidak tersedia</option>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quantity">Jumlah</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required min="1">
                </div>

                <div class="form-group">
                    <label for="price">Harga</label>
                    <input type="number" name="price" id="price" class="form-control" required min="0">
                </div>

                <button type="submit" class="btn btn-primary">Buat Order</button>
                <a href="index.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>