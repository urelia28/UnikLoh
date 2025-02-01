<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Produk</title>
    <link rel="stylesheet" href="../css/produk_tambah.css">
</head>
<body>
    <div class="form-container">
        <h1>Form Tambah Produk</h1>
        <form action="produk_simpan.php" method="post" enctype="multipart/form-data">
            <label for="nama">Nama Produk</label>
            <input type="text" id="nama" name="nama" required>

            <label for="kategori">Kategori</label>
            <select id="kategori" name="kategori" required>
                <?php
                // Koneksi ke database
                include '../koneksi.php'; // Tanda titik koma ditambahkan

                // Cek koneksi
                if ($koneksi->connect_error) {
                    die("Koneksi gagal: " . $koneksi->connect_error);
                }

                // Query untuk mengambil data kategori
                $sql = "SELECT id, name FROM categories "; // Pastikan nama tabel dan kolom sesuai
                $result = $koneksi->query($sql);

                // Mengecek hasil query
                if ($result->num_rows > 0) {
                    // Output data setiap baris
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Tidak ada kategori tersedia</option>";
                }
                ?>
            </select>

            <label for="description">Keterangan</label>
            <textarea id="description" name="description" rows="5" required></textarea>

            <label for="gambar">Gambar</label>
            <input type="file" id="gambar" name="gambar" accept="img/*" required>

            <label for="harga">Harga</label>
            <input type="text" id="harga" name="harga" required>

            <label for="stok">Jumlah Stok</label>
            <input type="text" id="stok" name="stok" required>

            <button type="submit">Submit</button>
            <button type="reset" class="reset-button">Reset</button>
            <button type="button" class="btn btn-outline-primary my-3" onclick="location.href='produk_tampilan.php'">Back</button>
        </form>
    </div>
</body>
</html>