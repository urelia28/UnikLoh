<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <!-- Memeriksa apakah sudah login -->
    <?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:../index.php?pesan=belum_login");
    exit; // Hentikan eksekusi setelah redirect
}
?>

    <!-- Header atau Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand"><i class="fas fa-tachometer-alt"></i> Admin Dashboard </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <center>
            <div class="collapse navbar-collapse" id="navbarNav">
                <div class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="index.php"><i class="fas fa-home"></i> Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="pelanggan.php"><i class="fas fa-users"></i> Customer</a></li>
                        <li class="nav-item"><a class="nav-link" href="transaksi.php"><i class="fas fa-exchange-alt"></i> Transaction</a></li>
                        <li class="nav-item"><a class="nav-link" href="produk_tampilan.php"><i class="fas fa-shopping-bag"></i> Produk</a></li>
                        <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
            </center>
        </div>
    </nav>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
