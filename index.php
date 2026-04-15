<?php
// index.php - AMMS Homepage
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>AMMS - Power in Simplicity</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
    <link rel="shortcut icon" href="assets/images/favicon.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <!-- HEADER -->
    <header class="site-header">
        <div class="container">
            <a href="index.php" class="logo">AMMS</a>
            <nav>
                <a href="index.php">Home</a>
                <a href="products.php">Shop</a>
                <a href="about.php">About</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <a href="admin/admin.php">Admin</a>
                    <?php endif; ?>
                    <a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>)</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero">
        <div class="hero-inner">
            <div class="hero-content">
                <h2>Power in Simplicity</h2>
                <p class="subtitle">Curated for the Discerning</p>
                <p class="tagline">AMMS celebrates the art of understated elegance. Every piece designed for those who
                    understand that true luxury whispers, never shouts.</p>
                <a href="products.php" class="btn">Explore Collection</a>
            </div>
            <div class="hero-image">
                <img src="assets/images/hero-main.jpg" alt="AMMS Collection">
            </div>
        </div>
    </section>

    <!-- FEATURED COLLECTION -->
    <section class="container featured">
        <h2>Featured Collection</h2>
        <div class="featured-grid">
            <a href="products.php" class="featured-card featured-card-link">
                <img src="assets/images/essentials.jpg" alt="Essentials">
                <h3>Essentials</h3>
                <p>Timeless pieces for everyday wear. Clean, refined, and effortlessly elegant.</p>
            </a>
            <a href="products.php" class="featured-card featured-card-link">
                <img src="assets/images/seasonal.jpg" alt="Seasonal">
                <h3>Seasonal Drops</h3>
                <p>Limited-edition collections released thoughtfully throughout the year.</p>
            </a>
            <a href="products.php" class="featured-card featured-card-link">
                <img src="assets/images/capsule.jpg" alt="Capsule">
                <h3>Capsule Wardrobe</h3>
                <p>The foundation of timeless style. Pieces that work together seamlessly.</p>
            </a>
        </div>
    </section>

    <!-- CAMPAIGN SECTION -->
    <section class="campaign">
        <div class="container">
            <div class="campaign-wrapper">
                <div class="campaign-image">
                    <img src="assets/images/campaign.jpg" alt="Redefining Modern Elegance">
                </div>
                <div class="campaign-content">
                    <h2>Redefining Modern Elegance</h2>
                    <p>AMMS was founded with a singular vision: to create fashion that transcends trends. We believe in
                        the power of simplicity—where every detail matters, and nothing is accidental.</p>
                    <p>Our collections feature clean lines, refined silhouettes, and a carefully curated monochromatic
                        palette. Designed for those who move with intention.</p>
                    <a href="about.php" class="btn btn-light">Learn Our Story</a>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Shop</h4>
                    <ul>
                        <li><a href="products.php">All Products</a></li>
                        <li><a href="products.php">New Arrivals</a></li>
                        <li><a href="products.php">Essentials</a></li>
                        <li><a href="products.php">Collections</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>About</h4>
                    <ul>
                        <li><a href="about.php">Our Story</a></li>
                        <li><a href="about.php#values">Values</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Customer Care</h4>
                    <ul>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="shipping.php">Shipping & Returns</a></li>
                        <li><a href="size_guide.php">Size Guide</a></li>
                        <li><a href="care_instructions.php">Care Instructions</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <form class="newsletter" method="post" action="subscribe.php">
                        <label for="newsletter_email_home">Subscribe to Updates</label>
                        <input id="newsletter_email_home" name="email" type="email" required
                            placeholder="your@email.com">
                        <button class="btn" type="submit">Subscribe</button>
                    </form>
                    <div class="social-links">
                        <a href="#" target="_blank" rel="noopener noreferrer" title="Instagram"
                            aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" target="_blank" rel="noopener noreferrer" title="Twitter X" aria-label="Twitter X"><i
                                class="fa-brands fa-x-twitter"></i></a>
                        <a href="#" target="_blank" rel="noopener noreferrer" title="LinkedIn" aria-label="LinkedIn"><i
                                class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity. | <a href="javascript:void(0)"
                        style="color:var(--text-light);text-decoration:none;">Privacy</a> • <a href="javascript:void(0)"
                        style="color:var(--text-light);text-decoration:none;">Terms</a></p>
            </div>
        </div>
    </footer>
    <script src="js/scripts.js" defer></script>
</body>

</html>
