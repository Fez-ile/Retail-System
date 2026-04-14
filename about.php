<?php
// about.php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>About AMMS - Power in Simplicity</title>
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

    <!-- ABOUT HERO -->
    <section class="about-hero">
        <div class="about-hero-content">
            <img src="assets/images/about-hero.jpg" alt="AMMS" class="about-hero-image">

        </div>
    </section>

    <!-- ABOUT CONTENT -->
    <main class="container about-content">
        <section class="about-section">
            <h2>Power in Simplicity</h2>
            <p>AMMS was created with a singular vision — to redefine modern elegance through simplicity. Founded on the
                belief that true luxury does not shout, but speaks with quiet confidence, AMMS delivers timeless pieces
                designed for individuals who understand the power of understated style.</p>
            <p>Every collection is curated with precision, focusing on clean lines, refined silhouettes, and a
                monochromatic aesthetic that transcends trends. We design for those who move with intention — bold,
                composed, and unapologetically authentic.</p>
            <p>At AMMS, fashion is not seasonal noise. It is identity. It is presence. It is power in simplicity.</p>
        </section>

        <section class="about-section">
            <h2>Our Philosophy</h2>
            <p>We believe that luxury is not about excess. It's about precision. Every seam, every stitch, every detail
                is intentional. We reject the noise of fast fashion and offer instead timeless pieces that endure—in
                style and in quality.</p>
            <p>Our minimalist aesthetic is rooted in the principle that less is more. We use a carefully curated color
                palette of blacks, whites, beiges, and greys to create a cohesive wardrobe that transcends seasons and
                trends. Each piece complements the others, allowing our customers to build a capsule wardrobe of lasting
                value.</p>
        </section>



        <section id="values" class="about-section">
            <h2>Our Values</h2>
            <div class="values">
                <div class="value-item">
                    <h3>Authenticity</h3>
                    <p>We design for the real, authentic self—not an aspirational fantasy. Our pieces celebrate
                        individuality through understated elegance.</p>
                </div>
                <div class="value-item">
                    <h3>Sustainability</h3>
                    <p>We prioritize ethical sourcing, responsible production, and timeless design that reduces waste
                        and promotes conscious consumption.</p>
                </div>
                <div class="value-item">
                    <h3>Precision</h3>
                    <p>Every detail matters. We obsess over the smallest elements because we know that true luxury is
                        found in perfection.</p>
                </div>
            </div>
        </section>

        <section class="about-section">
            <h2>The AMMS Story</h2>
            <p>AMMS began as a quiet rebellion against the noise of contemporary fashion. Founded by individuals who
                shared a vision for timeless style, AMMS emerged from a simple observation: the most elegant people wear
                the fewest clothes, but they wear them with intention.</p>
            <p>What started as a small collection of essential pieces has grown into a fully realized brand, trusted by
                discerning individuals who understand that power lies in simplicity. We remain committed to our founding
                principles—quality, authenticity, and the belief that true luxury whispers, never shouts.</p>
        </section>

        <section class="contact-cta" style="text-align:center;padding:60px 0;">
            <h2 style="margin-bottom:30px;">Get in Touch</h2>
            <p style="margin-bottom:30px;color:var(--text-light);">Have questions? We'd love to hear from you.</p>
            <a href="contact.php" class="btn">Contact AMMS</a>
        </section>
    </main>

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
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="shipping.php">Shipping & Returns</a></li>
                        <li><a href="size_guide.php">Size Guide</a></li>
                        <li><a href="care_instructions.php">Care Instructions</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <form class="newsletter" method="post" action="subscribe.php">
                        <label for="newsletter_email_about">Subscribe to Updates</label>
                        <input id="newsletter_email_about" name="email" type="email" required
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
