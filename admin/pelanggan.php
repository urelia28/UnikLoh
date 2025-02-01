<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h5>Data Customer</h5>
        </div>
        <div class="card-body">
            <a href="pelanggan_tambah.php" class="btn btn-primary mb-3">Tambah Data</a>
            <table class="table table-hover" id="table-datetable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone Number</th>
                        <th>alamat</th>
                        <th width="20%">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include "../koneksi.php";
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM customers ORDER BY id_user ASC");

                    while($data = mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['name'];?></td>
                        <td><?php echo $data['email'];?></td>
                        <td><?php echo $data['phone'];?></td>
                        <td><?php echo $data['address'];?></td>
                        <td>
                            <a href="pelanggan_edit.php?id=<?php echo $data ['id_user'];?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="pelanggan_hapus.php?id=<?php echo $data ['id_user'];?>" class="btn btn-danger btn-sm" onclick="return confirm('kamu yakin akan menghapusnya?')">Hapus</a>
                        </td>
                    <?php
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