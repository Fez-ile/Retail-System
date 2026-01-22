<?php
// index.php
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Smart Retail System</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <h1 class="logo">Smart Retail</h1>
            <nav>
                <?php if (isset($_SESSION['user'])): ?>
                    <a href="products.php">Products</a>
                    <a href="cart.php">Cart (<?php echo isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0; ?>)</a>
                    <a href="logout.php">Logout</a>
                <?php else: ?>
                    <a href="register.php">Register</a>
                    <a href="login.php">Login</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>

    <main class="container">
        <section class="hero">
            <h2>Welcome to the Smart Retail System</h2>
            <p>Smarter Shopping, Simplified.</p>
            <p><a class="btn" href="products.php">Browse Products</a></p>
        </section>

        <section class="features">
            <div class="card">
                <h3>For Customers</h3>
                <p>Register, browse products, add to cart and checkout.</p>
            </div>
            <div class="card">
                <h3>For Admin</h3>
                <p>Log in with admin account to add/update products (basic).</p>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">&copy; <?php echo date('Y'); ?> Smart Retail System</div>
    </footer>
</body>

</html>