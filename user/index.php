<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UnikLoh</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="../css/index.css">
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const links = document.querySelectorAll("nav a");
            links.forEach(link => {
                link.addEventListener("click", function (event) {
                    event.preventDefault();
                    const targetUrl = this.href;
                    document.body.classList.add("slide-in");
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
                <li><a href="wanita.php"><i class="fa-solid fa-person-dress"></i> Wanita</a></li>
                <li><a href="pria.php"><i class="fa-solid fa-person"></i> Pria</a></li>
                <li><a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>
    </header>
    <div class="hero">
        <img src="../img/campuran.jpg" alt="Hero Image">
        <img src="../img/bg.jpg" alt="Hero Image">
    </div>
    <section class="products">
        <h1>PRODUK TERLARIS</h1>
    <section class="product-list">
        <div class="product-card">
            <div class="product-label">Terlaris</div>
            <img src="../img/produk1.png" alt="Classic Blue Breeze" class="product-image">
            <h2 class="product-name">Classic Blue Breeze</h2>
            <p class="product-price">
                Rp 100.000 <span class="product-discount">Rp 150.000</span></p>
        </div>
        <div class="product-card">
            <div class="product-label">Terlaris</div>
            <img src="../img/produk2.png" alt="Denim Jacket" class="product-image">
            <h2 class="product-name">Denim Jacket</h2>
            <p class="product-price">
                Rp 80.000 <span class="product-discount">Rp 120.000</span></p>
        </div>
        <div class="product-card">
            <div class="product-label">Terlaris</div>
            <img src="../img/produk3.png" alt="Dusty Dawn Hoodie" class="product-image">
            <h2 class="product-name">Dusty Dawn Hoodie</h2>
            <p class="product-price">
                Rp 180.000 <span class="product-discount">Rp 250.000</span></p>
        </div>
    </section>
    <section class="promotions">
        <h1>PROMOSI ACARA</h1>
        <div class="promo-list">
            <div class="promo-item">
                <img src="../img/promo2.png" alt="Promo 1">
                <h2>Urban Essentials</h2>
                <h5>Koleksi streetwear pria yang menghadirkan kaos oversized, jaket statement, dan kemeja edgy 
                untuk gaya urban yang autentik.</h5>
            </div>
            <div class="promo-item">
                <img src="../img/promo1.png" alt="Promo 2">
                <h2>Spring Spectrum</h2>
                <h5>Koleksi wanita yang merayakan keberagaman, menampilkan paduan warna pastel dan netral dalam potongan santai namun chic untuk gaya musim semi yang segar dan inklusif.</h5>
            </div>
        </div>
    </section>
    <footer>
    <p>&copy; 2025 UnikLoh. All rights reserved.</p>
    <div style="margin: 10px 0;">
        <a href="https://www.instagram.com" target="_blank" style="color: #fff; margin: 0 10px;">
            <i class="fab fa-instagram" style="font-size: 24px;"></i>
        </a>
        <a href="https://www.facebook.com" target="_blank" style="color: #fff; margin: 0 10px;">
            <i class="fab fa-facebook" style="font-size: 24px;"></i>
        </a>
        <a href="mailto:info@unikloh.com" style="color: #fff; margin: 0 10px;">
            <i class="fas fa-envelope" style="font-size: 24px;"></i>
        </a>
    </div>
    <p>
        <a href="https://www.instagram.com" style="color: #fff; text-decoration: none;">Instagram</a> |
        <a href="https://www.facebook.com" style="color: #fff; text-decoration: none;">Facebook</a> |
        <a href="mailto:info@unikloh.com" style="color: #fff; text-decoration: none;">Email</a>
    </p>
</footer>
</body>
</html>