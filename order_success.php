<?php
// order_success.php
session_start();
$order_id = (int) ($_GET['order_id'] ?? 0);
$msg = $_SESSION['order_success'] ?? '';
unset($_SESSION['order_success']);
if (!$msg) {
    $msg = 'Thank you for shopping with us.';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Order Confirmed - AMMS</title>
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
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container" style="padding:100px 0;text-align:center;">
        <h2 style="font-family:var(--serif);font-size:48px;margin-bottom:20px;">Order Confirmed</h2>

        <div class="success" style="max-width:600px;margin:0 auto 40px;padding:30px;">
            <?php echo htmlspecialchars($msg); ?>
        </div>

        <div style="margin:40px 0;">
            <p style="color:var(--text-light);font-size:14px;margin-bottom:10px;">ORDER REFERENCE</p>
            <p style="font-family:var(--serif);font-size:32px;margin:0;letter-spacing:2px;">#<?php echo $order_id; ?>
            </p>
        </div>

        <div style="margin:60px 0;">
            <p style="color:var(--text-light);font-size:14px;margin-bottom:30px;">A confirmation email has been sent to
                your account.</p>
            <a href="products.php" class="btn">Continue Shopping</a>
        </div>

        <div
            style="margin-top:80px;padding-top:40px;border-top:1px solid var(--border-light);color:var(--text-light);font-size:14px;">
            <p>Thank you for choosing AMMS. Your order will be processed and shipped shortly.</p>
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
                        <li><a href="javascript:void(0)">Orders</a></li>
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
