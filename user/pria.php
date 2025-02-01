<?php
include '../koneksi.php';

// Filter produk berdasarkan kategori 'pria'
$query = "SELECT * FROM products WHERE category_id = '1-pria'";
$result = $koneksi->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pria - UnikLoh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/pria.css">
</head>
<body>
<script>
        document.addEventListener("DOMContentLoaded", () => {
            const links = document.querySelectorAll("nav a");
            links.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault();
                    const targetUrl = this.href;
                    document.body.classList.add("slide-out");
                    setTimeout(() => {
                        window.location.href = targetUrl;
                    }, 500);
                });
            });
        });
    </script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="../img/logo.png" alt="UnikLoh Logo">
            <h2>UnikLoh</h2>
        </div>
        <nav>
            <ul>
                <li><a href="index.php"><i class="fa-solid fa-house"></i> Home</a>
                <li><a href="wanita.php"><i class="fa-solid fa-person-dress"></i> Wanita</a></li>
                <li><a href="pria.php"><i class="fa-solid fa-person"></i> Pria</a></li>
                <li><a href="order.php"><i class="fa-solid fa-shopping-cart"></i> Order</a></li>
            </ul>
        </nav>
    </header>
    <div class="hero">
        <img src="../img/foto3.png" alt="Hero Image">
    </div>
    <section class="product-list">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="product-card">
                    <?php if (!empty($row['label'])): ?>
                        <div class="product-label"><?= htmlspecialchars($row['label']) ?></div>
                    <?php endif; ?>
                    <img src="../img/<?= htmlspecialchars($row['gambar']) ?>" alt="<?= htmlspecialchars($row['name']) ?>" class="product-image">
                    <h2 class="product-name"><?= htmlspecialchars($row['name']) ?></h2>
                    <p class="product-price">
                        Rp <?= number_format($row['price'], 0, ',', '.') ?>
                        <?php if (!empty($row['discount_price'])): ?>
                            <span class="product-discount">Rp <?= number_format($row['discount_price'], 0, ',', '.') ?></span>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No products found for this category.</p>
        <?php endif; ?>
    </section>
</body>
</html>
