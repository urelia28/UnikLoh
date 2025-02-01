<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Edit Customer Data</h4>
                </div>
                <div class="card-body">
                    <?php
                    include '../koneksi.php';
                    
                    $id = $_GET['id'];
                    $data = mysqli_query($koneksi, "SELECT * FROM customers WHERE id_user='$id'");
                    while ($d = mysqli_fetch_array($data)) {
                    ?>
                        <form method="post" action="pelanggan_update.php">
                            <input type="hidden" name="id" value="<?php echo $d['id_user']; ?>">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama .." value="<?php echo $d['name']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">email</label>
                                <input type="text" class="form-control" id="email" name="email" placeholder="Masukkan nama .." value="<?php echo $d['email']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="hp" class="form-label">HP</label>
                                <input type="number" class="form-control" id="hp" name="hp" placeholder="Masukkan no.hp .." value="<?php echo $d['phone']; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alt" placeholder="Masukkan alamat .." value="<?php echo $d['address']; ?>">
                            </div>
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                            <button type="submit" class="btn btn-outline-primary"onclick="location.href='pelanggan.php'">Kembali</button>
                        </form>
                    <?php 
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>