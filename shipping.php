<?php
// shipping.php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shipping - AMMS</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <a href="index.php" class="logo">AMMS</a>
            <nav>
                <a href="index.php">Home</a>
                <a href="products.php">Shop</a>
                <a href="about.php">About</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding:60px 20px;">
        <h2>Shipping & Returns</h2>
        <p style="color:var(--text-light);">We strive to deliver a premium, reliable shipping experience.</p>

        <section style="margin-top:30px;">
            <h3>Free Shipping</h3>
            <p>Orders over <strong>R 500</strong> qualify for free standard shipping. This applies to domestic orders
                only.
            </p>
        </section>

        <section style="margin-top:20px;">
            <h3>Standard Delivery</h3>
            <p>Standard delivery typically takes 3-7 business days depending on your location.
            </p>
        </section>

        <section style="margin-top:20px;">
            <h3>International Shipping</h3>
            <p>International shipping rates and delivery times vary by country. Duties and taxes may apply and are the
                responsibility of the recipient.</p>
        </section>

        <section style="margin-top:20px;">
            <h3>Returns</h3>
            <p>Returns accepted within 14 days of delivery. Items must be unworn, unwashed and in original condition.
            </p>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity.</p>
            </div>
        </div>
    </footer>
</body>

</html>