<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
</head>
<body>
<?php include 'header.php';?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Produk</h5>
        </div>
        <div class="card-body">
            <a href="produk_tambah.php" class="btn btn-primary mb-3">Tambah Produk</a>
            <table class="table table-hover" id="table-datetable">
                <thead>
                <tr>
                        <th>No</th>
                        <th>nama</th>
                        <th width="20%">description</th>
                        <th>price</th>
                        <th width="10%">image</th>
                        <th>stock</th>
                        <th width="15%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
            <?php include '../koneksi.php';
                $query = "SELECT * FROM products ORDER BY id ASC";
                $select_produk = mysqli_query($koneksi, $query);

                if (!$select_produk) {
                    die("Error pada query: " . mysqli_error($koneksi));
                }

                if (mysqli_num_rows($select_produk) > 0) {
                    $no = 1;
                    while ($data = mysqli_fetch_array($select_produk)) {
                ?>
                    <tr>
                    <td><?php echo $no++; ?></td>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo substr($data['description'], 0, 100); ?>...</td>
                <td><?php echo $data['price']; ?></td>
                <td><?php echo "<img src='../img/$data[gambar]' width=100 height=100 >"; ?></td>
                <td><?php echo $data['stock']; ?></td>
                <td>
                <a href="produk_edit.php?kdproduk=<?php echo $data ['id'];?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="produk_hapus.php?kdproduk=<?php echo $data ['id'];?>" class="btn btn-danger btn-sm" onclick="return confirm('kamu yakin akan menghapusnya?')">Hapus</a>
            </td>
            </tr>
    <?php
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>Tidak ada data berita</td></tr>";
    }
    ?>
</tbody>
            </div>
        </div>
    </div>
</div>
</body>
</html>
                <!--data tables-->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.min.css">

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>

<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function(){
    $('#table-datetable').DataTable();
    });
</script>