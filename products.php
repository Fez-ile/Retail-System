<?php
// products.php
session_start();
require 'config.php';

$result = $mysqli->query("
    SELECT id,name,description,price,stock
    FROM products
    WHERE name NOT IN ('White T-Shirt', 'Black Jeans', 'Running Shoes')
    ORDER BY created_at DESC
");
$products = $result->fetch_all(MYSQLI_ASSOC);

$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shop - AMMS</title>
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

    <main class="container products">
        <h2>Shop Our Collection</h2>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error"><?php echo htmlspecialchars($_SESSION['error']);
            unset($_SESSION['error']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['message'])): ?>
            <div class="success"><?php echo htmlspecialchars($_SESSION['message']);
            unset($_SESSION['message']); ?></div>
        <?php endif; ?>

        <?php if (count($products) === 0): ?>
            <p class="notice" style="text-align:center;">No products available at this moment. Check back soon.</p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($products as $p): ?>
                    <?php
                    // determine image path by slugified product name
                    $slug = strtolower(preg_replace('/[^A-Za-z0-9]+/', '-', trim($p['name'])));
                    $jpg = 'assets/images/' . $slug . '.jpg';
                    $png = 'assets/images/' . $slug . '.png';
                    $svg = 'assets/images/' . $slug . '.svg';
                    $imgSrc = '';
                    if (file_exists(__DIR__ . '/' . $jpg)) {
                        $imgSrc = $jpg;
                    } elseif (file_exists(__DIR__ . '/' . $png)) {
                        $imgSrc = $png;
                    } elseif (file_exists(__DIR__ . '/' . $svg)) {
                        $imgSrc = $svg;
                    } else {
                        $imgSrc = "data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 400'><rect fill='%23e8e8e8'/></svg>";
                    }
                    ?>
                    <div class="product-card">
                        <a href="product_detail.php?id=<?php echo $p['id']; ?>" class="product-card-link">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
                            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                        </a>
                        <div class="product-info">
                            <p><?php echo htmlspecialchars(substr($p['description'], 0, 60)) . (strlen($p['description']) > 60 ? '...' : ''); ?>
                            </p>
                            <p class="price">R <?php echo number_format($p['price'], 2); ?></p>
                            <p class="stock-status">
                                <?php echo $p['stock'] > 0 ? 'In Stock' : 'Sold Out'; ?>
                            </p>
                        </div>

                        <form method="post" action="add_to_cart.php" class="requires-size-form">
                            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                            <div class="purchase-controls">
                                <div class="control-field">
                                    <label for="size-<?php echo $p['id']; ?>">Size</label>
                                    <select id="size-<?php echo $p['id']; ?>" name="size" class="size-select" required>
                                        <option value="">Select</option>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <div class="control-field control-qty">
                                    <label for="qty-<?php echo $p['id']; ?>">Qty</label>
                                    <input id="qty-<?php echo $p['id']; ?>" type="number" name="quantity" value="1" min="1"
                                        max="<?php echo (int) $p['stock']; ?>">
                                </div>
                            </div>
                            <p class="field-error" aria-live="polite"></p>
                            <button class="btn add-to-cart-btn" type="submit" <?php echo $p['stock'] <= 0 ? 'disabled' : ''; ?>>
                                <span class="cart-btn-icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 5h2l2.2 9.2a1 1 0 0 0 1 .8h8.9a1 1 0 0 0 1-.8L20 8H7.2" stroke="currentColor"
                                            stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
                                        <circle cx="10" cy="19" r="1.5" fill="currentColor" />
                                        <circle cx="17" cy="19" r="1.5" fill="currentColor" />
                                    </svg>
                                </span>
                                <span>Add to Cart</span>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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
</body>

</html>
