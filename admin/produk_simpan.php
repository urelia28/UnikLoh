<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $nama = htmlspecialchars($_POST['nama']);
    $description = htmlspecialchars($_POST['description']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $harga = htmlspecialchars($_POST['harga']);
    $stok = htmlspecialchars($_POST['stok']);
    
    // Proses upload file gambar
    $target_dir = "../img/";
    $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
    $target_file = $target_dir . uniqid() . '.' . $imageFileType;
    $uploadOk = 1;

    // Periksa apakah file gambar valid
    if (!isset($_FILES["gambar"]) || $_FILES["gambar"]["error"] != 0) {
        echo "Tidak ada file yang diunggah atau terjadi kesalahan.";
        $uploadOk = 0;
    } else {
        $check = getimagesize($_FILES["gambar"]["tmp_name"]);
        if ($check === false) {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Periksa ukuran file
        if ($_FILES["gambar"]["size"] > 500000) {
            echo "Ukuran file terlalu besar.";
            $uploadOk = 0;
        }

        // Periksa format file
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "Hanya file JPG, JPEG, PNG, dan GIF yang diizinkan.";
            $uploadOk = 0;
        }
    }

    // Jika semua oke, upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            echo "File " . htmlspecialchars(basename($_FILES["gambar"]["name"])) . " berhasil diunggah.";

            // Simpan data ke database
            $koneksi = new mysqli("localhost", "root", "", "butik");
            if ($koneksi->connect_error) {
                die("Koneksi gagal: " . $koneksi->connect_error);
            }

            $sql = "INSERT INTO products (name, description, category_id, gambar, price, stock) 
                    VALUES ('$nama', '$description', '$kategori', '$target_file', '$harga', '$stok')";
            if ($koneksi->query($sql) === TRUE) {
                echo "Produk berhasil disimpan.";
            } else {
                echo "Error: " . $sql . "<br>" . $koneksi->error;
            }

            $koneksi->close();
        } else {
            echo "Terjadi kesalahan saat mengunggah file.";
        }
    }
}
?>
<script>document.location='produk_tampilan.php'</script>