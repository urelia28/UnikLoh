<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Admin</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            background-color: black;
            color: white;
            min-height: 100vh;
            margin: 0;
        }
        main {
            flex: 1;
        }
        footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 1rem 0;
        }
    </style>
</head>
<body>
<?php
session_start();
include 'header.php';
include '../koneksi.php';

// Periksa apakah sesi username ada
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php?pesan=unauthorized");
    exit();
}

// Mendapatkan total pelanggan dan transaksi
$result = mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM customers");
$data = mysqli_fetch_assoc($result);
$total_pelanggan = htmlspecialchars($data['total']); // Escaping data

$result = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM transactions");
$data = mysqli_fetch_assoc($result);
$total_transaksi = htmlspecialchars($data['jumlah']); // Escaping data

$result = mysqli_query($koneksi, "SELECT COUNT(*) AS jumlah FROM products");
$data = mysqli_fetch_assoc($result);
$total_produk = htmlspecialchars($data['jumlah']); // Escaping data

// Mengambil data transaksi per tanggal
$query = "SELECT date, COUNT(*) AS jumlah_transaksi 
          FROM transactions 
          GROUP BY date 
          ORDER BY date ASC";
$result = mysqli_query($koneksi, $query);

$dates = [];
$transactions = [];

while ($row = mysqli_fetch_assoc($result)) {
    $dates[] = htmlspecialchars($row['date']); // Escaping data
    $transactions[] = htmlspecialchars($row['jumlah_transaksi']); // Escaping data
    
}
?>
    <!-- Konten Utama -->
    <main class="container mt-4">
        <h6 class="alert alert-info"><b>Selamat Datang!</b> Di Outlet UnikLoh</h6>
        <h1>Hi, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Customers</h5>
                        <p class="card-text">Total <b style="color:red;"><?php echo $total_pelanggan; ?></b> Register Customers</p>
                        <a href="pelanggan.php" class="btn btn-outline-danger">View Customers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Transaksi</h5>
                        <p class="card-text">Total <b style="color:green;"><?php echo $total_transaksi; ?></b> Transaksi Customers</p>
                        <a href="transaksi.php" class="btn btn-outline-success">View Transaksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Produk</h5>
                        <p class="card-text">Total <b style="color:green;"><?php echo $total_produk; ?></b> Produk</p>
                        <a href="produk_tampilan.php" class="btn btn-outline-success">View Produk</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik Transaksi -->
        <div class="mt-4">
            <h4>Grafik Transaksi Harian</h4>
            <canvas id="grafikTransaksi"></canvas>
        </div>
    </main>
    <!-- Footer -->
    <footer>
        &copy; 2025 UnikLoh. All rights reserved.
    </footer>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk Chart.js
        const dates = <?php echo json_encode($dates); ?>;
        const transactions = <?php echo json_encode($transactions); ?>;

        // Konfigurasi Chart.js
        const ctx = document.getElementById('grafikTransaksi').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Jumlah Transaksi',
                    data: transactions,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
