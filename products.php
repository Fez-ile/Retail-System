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
                        <a href="product_detail.php?id=<?php echo $p['id']; ?>" style="text-decoration:none; color:inherit;">
                            <img src="<?php echo $imgSrc; ?>" alt="<?php echo htmlspecialchars($p['name']); ?>">
                            <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                        </a>
                        <p><?php echo htmlspecialchars(substr($p['description'], 0, 60)) . (strlen($p['description']) > 60 ? '...' : ''); ?>
                        </p>
                        <p class="price">R <?php echo number_format($p['price'], 2); ?></p>
                        <p style="font-size:12px;color:var(--text-light);">
                            <?php echo $p['stock'] > 0 ? 'In Stock' : 'Sold Out'; ?>
                        </p>

                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                            <div class="form-group" style="display:flex;gap:10px;">
                                <input type="number" name="quantity" value="1" min="1" max="<?php echo (int) $p['stock']; ?>"
                                    style="width:60px;">
                                <button class="btn" type="submit" <?php echo $p['stock'] <= 0 ? 'disabled' : ''; ?>>Add to
                                    Cart</button>
                            </div>
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