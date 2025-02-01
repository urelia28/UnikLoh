<?php
include "../koneksi.php";

if (isset($_GET['kdproduk'])) {
    $nomor = $_GET['kdproduk'];

    // Ambil data dari database berdasarkan nomor
    $query = "SELECT * FROM products WHERE id = '$nomor'";
    $result = mysqli_query($koneksi, $query);

    if (!$result) {
        die("Error pada query: " . mysqli_error($koneksi));
    }

    $data = mysqli_fetch_assoc($result);

    if (!$data) {
        echo "<script>alert('Data tidak ditemukan!'); document.location='produk_tampilan.php';</script>";
        exit;
    }
} else {
    echo "<script>alert('ID produk tidak valid!'); document.location='produk_tampilan.php';</script>";
    exit;
}

if (isset($_POST['update'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['description']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['price']);
    $stok = mysqli_real_escape_string($koneksi, $_POST['stock']);

    $vfoto = $_FILES['fupload']['name'];
    $tfoto = $_FILES['fupload']['tmp_name'];
    $dirl = "img/";

    if (!empty($vfoto)) {
        $upload = $dirl . basename($vfoto);
        move_uploaded_file($tfoto, $upload);
        $query_update = "UPDATE products SET name = '$nama', description = '$deskripsi', price = '$harga', stock = '$stok', gambar = '$vfoto' WHERE id = '$nomor'";
    } else {
        $query_update = "UPDATE products SET name = '$nama', description = '$deskripsi', price = '$harga', stock = '$stok' WHERE id = '$nomor'";
    }

    $update = mysqli_query($koneksi, $query_update);

    if ($update) {
        echo "<script>alert('Produk berhasil diperbarui!'); document.location='produk_tampilan.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk: " . mysqli_error($koneksi) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/edit.css">
    <link rel="icon" type="image/png" href="../img/icon_tribe.png">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Produk</h2>
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="description" name="description" rows="5" required><?php echo $data['description']; ?></textarea>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price" value="<?php echo $data['price']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="stock" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?php echo $data['stock']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="fupload" class="form-label">Gambar Produk (Kosongkan jika tidak ingin mengubah)</label><br>
                <img src="img/<?php echo $data['gambar']; ?>" alt="Gambar Produk" width="100" class="mb-2"><br>
                <input type="file" class="form-control" id="fupload" name="fupload">
            </div>
            <button type="submit" name="update" class="btn btn-primary mt-3">Update Produk</button>
            <button type="button" class="btn btn-danger mt-3" onclick="location.href='produk_tampilan.php'">Back</button>

        </form>
    </div>

    <script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>