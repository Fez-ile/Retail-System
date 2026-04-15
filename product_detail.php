<?php
// product_detail.php
session_start();
require 'config.php';

if (!isset($_GET['id'])) {
    header('Location: products.php');
    exit;
}

$id = (int) $_GET['id'];
$result = $mysqli->query("SELECT id,name,description,price,stock FROM products WHERE id = $id");

if ($result->num_rows === 0) {
    header('Location: products.php');
    exit;
}

$product = $result->fetch_assoc();
$slug = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', trim($product['name'])));
$jpg = 'assets/images/' . $slug . '.jpg';
$png = 'assets/images/' . $slug . '.png';
$svg = 'assets/images/' . $slug . '.svg';
$mainImg = '';
if (file_exists(__DIR__ . '/' . $jpg)) {
    $mainImg = $jpg;
} elseif (file_exists(__DIR__ . '/' . $png)) {
    $mainImg = $png;
} elseif (file_exists(__DIR__ . '/' . $svg)) {
    $mainImg = $svg;
} else {
    $mainImg = "data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 500 600'><rect fill='%23e8e8e8'/></svg>";
}
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?php echo htmlspecialchars($product['name']); ?> - AMMS</title>
    <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
    <link rel="shortcut icon" href="assets/images/favicon.jpg">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
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
                    <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                    <a href="register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container product-detail">
        <div style="margin-bottom:30px;">
            <a href="products.php"
                style="color:var(--text-light);text-decoration:none;font-size:12px;letter-spacing:1px;text-transform:uppercase;">←
                Back to Shop</a>
        </div>

        <div class="detail-grid">
            <!-- LEFT: IMAGE GALLERY -->
                <div class="detail-image">
                <img id="mainImage" src="<?php echo $mainImg; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                <div class="detail-thumbs">
                    <img class="thumb active" src="<?php echo $mainImg; ?>" onclick="changeImage(this)">
                    <img class="thumb" src="<?php echo $mainImg; ?>" onclick="changeImage(this)">
                    <img class="thumb" src="<?php echo $mainImg; ?>" onclick="changeImage(this)">
                    <img class="thumb" src="<?php echo $mainImg; ?>" onclick="changeImage(this)">
                </div>
            </div>

            <!-- RIGHT: PRODUCT INFO -->
            <div class="detail-info">
                <h1><?php echo htmlspecialchars($product['name']); ?></h1>
                <p class="price">R <?php echo number_format($product['price'], 2); ?></p>

                <p class="detail-description">
                    <?php echo nl2br(htmlspecialchars($product['description'])); ?>
                </p>

                <!-- ADD TO CART FORM -->
                <form method="post" action="add_to_cart.php" class="requires-size-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">

                    <div class="form-group">
                        <label>Size</label>
                        <select name="size" required>
                            <option value="">Select Size</option>
                            <option value="XS">Extra Small</option>
                            <option value="S">Small</option>
                            <option value="M">Medium</option>
                            <option value="L">Large</option>
                            <option value="XL">Extra Large</option>
                        </select>
                        <p class="field-error" aria-live="polite"></p>
                    </div>

                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" name="quantity" value="1" min="1"
                            max="<?php echo (int) $product['stock']; ?>" required>
                    </div>

                    <button class="btn" type="submit" <?php echo $product['stock'] <= 0 ? 'disabled' : ''; ?>>
                        <?php echo $product['stock'] > 0 ? 'Add to Cart' : 'Out of Stock'; ?>
                    </button>
                </form>

                <p
                    style="margin-top:30px;padding-top:30px;border-top:1px solid var(--border-light);color:var(--text-light);font-size:13px;">
                    Stock Status:
                    <strong><?php echo $product['stock'] > 0 ? $product['stock'] . ' Available' : 'Out of Stock'; ?></strong>
                </p>

                <!-- EXPANDABLE DETAILS -->
                <div class="detail-specs">
                    <div class="spec-item">
                        <div class="spec-title" onclick="toggleSpec(this)">
                            <span>Material & Care</span>
                            <span>+</span>
                        </div>
                        <div class="spec-content">
                            <p>100% premium cotton. Hand-wash with cold water or dry clean. Lay flat to dry. Iron on low
                                heat if needed.</p>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-title" onclick="toggleSpec(this)">
                            <span>Shipping & Returns</span>
                            <span>+</span>
                        </div>
                        <div class="spec-content">
                            <p>Free shipping on orders over R 500. Standard delivery 5-7 business days. Returns accepted
                                within 30 days in original condition.</p>
                        </div>
                    </div>

                    <div class="spec-item">
                        <div class="spec-title" onclick="toggleSpec(this)">
                            <span>Size Guide</span>
                            <span>+</span>
                        </div>
                        <div class="spec-content">
                            <p>XS: Bust 32" | S: Bust 34" | M: Bust 36" | L: Bust 38" | XL: Bust 40". For the best fit,
                                please refer to individual product measurements.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <li><a href="shipping.php">Shipping</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Connect</h4>
                    <form class="newsletter" method="post" action="subscribe.php">
                        <input name="email" type="email" required placeholder="your@email.com">
                        <button class="btn" type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity.</p>
            </div>
        </div>
    </footer>

    <script>
        function changeImage(element) {
            document.querySelectorAll('.detail-thumbs .thumb').forEach(el => el.classList.remove('active'));
            element.classList.add('active');
            document.getElementById('mainImage').src = element.src;
        }

        function toggleSpec(element) {
            const content = element.nextElementSibling;
            const isActive = content.classList.contains('active');
            document.querySelectorAll('.spec-content').forEach(el => el.classList.remove('active'));
            document.querySelectorAll('.spec-title').forEach(el => el.style.color = 'inherit');
 if (!isActive) {
                content.classList.add('active');
                element.style.color = 'var(--text-dark)';
                element.querySelector('span:last-child').textContent = '−';
            }
        }
    </script>
</body>

</html>
