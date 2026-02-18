<?php
// care_instructions.php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Care Instructions - AMMS</title>
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

    <main class="container" style="padding:60px 20px;max-width:900px;margin:60px auto;">
        <h2>Care Instructions</h2>
        <p style="color:var(--text-light);max-width:650px;">
            Proper care keeps your AMMS pieces looking sharp for longer. Always check the care label on your garment
            first – the guidelines below are general recommendations.
        </p>

        <section style="margin-top:30px;">
            <h3>Cotton & Jersey</h3>
            <ul>
                <li>Machine wash cold (30°C) with similar colours.</li>
                <li>Use mild detergent; avoid bleach and harsh softeners.</li>
                <li>Reshape while damp and lay flat or hang to dry.</li>
                <li>Iron on low to medium heat on the reverse side.</li>
            </ul>
        </section>

        <section style="margin-top:30px;">
            <h3>Denim</h3>
            <ul>
                <li>Wash inside out in cold water to preserve colour.</li>
                <li>Wash only when necessary; spot clean when possible.</li>
                <li>Avoid tumble drying – hang to dry away from direct sun.</li>
            </ul>
        </section>

        <section style="margin-top:30px;">
            <h3>Knitwear & Wool</h3>
            <ul>
                <li>Hand wash cold or use a gentle wool cycle.</li>
                <li>Use wool-safe detergent only.</li>
                <li>Do not wring; gently press out excess water and lay flat to dry.</li>
                <li>Store folded rather than hanging to avoid stretching.</li>
            </ul>
        </section>

        <section style="margin-top:30px;">
            <h3>Leather & Accessories</h3>
            <ul>
                <li>Wipe with a soft, dry or slightly damp cloth.</li>
                <li>Avoid prolonged exposure to water, heat and direct sunlight.</li>
                <li>Use a suitable leather conditioner occasionally to maintain softness.</li>
                <li>Store in a cool, dry place; use dust bags where provided.</li>
            </ul>
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

