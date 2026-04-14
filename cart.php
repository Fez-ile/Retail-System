<?php
// cart.php
session_start();
require 'config.php';

$cart = $_SESSION['cart'] ?? [];
$cartSizes = $_SESSION['cart_sizes'] ?? [];
$items = [];
$total = 0.00;

if ($cart) {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $sql = "SELECT id,name,price,stock FROM products WHERE id IN ($ids)";
    $res = $mysqli->query($sql);
    while ($row = $res->fetch_assoc()) {
        $pid = $row['id'];
        $qty = $cart[$pid];
        $row['qty'] = $qty;
        $row['size'] = $cartSizes[$pid] ?? 'M';
        $row['subtotal'] = $qty * $row['price'];
        $items[] = $row;
        $total += $row['subtotal'];
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shopping Cart - AMMS</title>
    <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
    <link rel="shortcut icon" href="assets/images/favicon.jpg">
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

    <main class="container cart-page">
        <h2>Your Cart</h2>

        <?php if (!$items): ?>
            <div style="text-align:center;padding:60px 0;">
                <p style="font-size:16px;color:var(--text-light);margin-bottom:30px;">Your cart is empty. Explore our
                    collection.</p>
                <a href="products.php" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($it['name']); ?></td>
                            <td>R <?php echo number_format($it['price'], 2); ?></td>
                            <td><?php echo htmlspecialchars($it['size']); ?></td>
                            <td><?php echo (int) $it['qty']; ?></td>
                            <td>R <?php echo number_format($it['subtotal'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="cart-total">
                <p style="font-size:14px;color:var(--text-light);">Subtotal</p>
                <p style="margin-bottom:20px;">R <?php echo number_format($total, 2); ?></p>
                <p style="font-size:12px;color:var(--text-light);text-transform:uppercase;">Free shipping on orders over R
                    500</p>
            </div>

            <div class="cart-actions">
                <a href="products.php" class="btn btn-light">Continue Shopping</a>
                <?php if (isset($_SESSION['user'])): ?>
                    <form method="post" action="checkout.php" style="display:contents;">
                        <button class="btn" type="submit">Proceed to Checkout</button>
                    </form>
                <?php else: ?>
                    <a href="login.php" class="btn">Login to Checkout</a>
                <?php endif; ?>
            </div>

            <?php if (!isset($_SESSION['user'])): ?>
                <div style="text-align:center;margin-top:40px;padding:30px;border-top:1px solid var(--border-light);">
                    <p style="color:var(--text-light);font-size:14px;">Please <a href="login.php"
                            style="color:var(--text-dark);text-decoration:underline;">login</a> or <a href="register.php"
                            style="color:var(--text-dark);text-decoration:underline;">register</a> to complete your purchase.
                    </p>
                </div>
            <?php endif; ?>
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
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>About</h4>
                    <ul>
                        <li><a href="about.php">Our Story</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Customer Care</h4>
                    <ul>
                        <li><a href="shipping.php">Shipping</a></li>
                        <li><a href="javascript:void(0)">Returns</a></li>
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
