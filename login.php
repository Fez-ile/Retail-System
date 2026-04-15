<?php
// login.php
session_start();
if (isset($_SESSION['user']))
    header('Location: products.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - AMMS</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
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
                <a href="register.php">Register</a>
            </nav>
        </div>
    </header>

    <main class="auth">
        <h2>Customer Login</h2>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="error">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="process_login.php" method="post">
            <label>Email Address</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit" class="btn" style="width:100%;margin-top:10px;">Sign In</button>
        </form>

        <p style="text-align:center;margin-top:30px;color:var(--text-light);">
            Don't have an account? <a href="register.php"
                style="color:var(--text-dark);text-decoration:underline;">Create one</a>
        </p>
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
                        <li><a href="javascript:void(0)">Help</a></li>
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
