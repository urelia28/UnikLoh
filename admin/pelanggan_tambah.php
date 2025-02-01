<?php include 'header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Add Customer</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="pelanggan_aksi.php">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Masukkan Nama Anda</label>
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Type customer name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Masukkan Email Anda</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Type customer email" required>
                        </div>
                        <div class="mb-3">
                            <label for="hp" class="form-label">Masukkan No HP</label>
                            <input type="text" class="form-control" id="hp" name="hp" placeholder="Type customer phone number" pattern="^\d{10,15}$" title="Nomor telepon harus terdiri dari 10-15 digit angka" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Masukkan Alamat</label>
                            <textarea class="form-control" id="alamat" name="alt" placeholder="Type customer address" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-outline-primary">Simpan</button>
                        <button type="reset" class="btn btn-secondary">Reset</button>
                        <a href="pelanggan.php" class="btn btn-danger">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
