<?php
// products.php
session_start();
require 'config.php';

$result = $mysqli->query("SELECT id,name,description,price,stock FROM products ORDER BY created_at DESC");
$products = $result->fetch_all(MYSQLI_ASSOC);

// simple cart count
$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Products - Smart Retail</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <header class="site-header">
        <div class="container">
            <h1 class="logo">Smart Retail</h1>
            <nav>
                <a href="index.php">Home</a>
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

    <main class="container">
        <h2>Products</h2>
        <?php if (count($products) === 0): ?>
            <p class="notice">Out of stock</p>
        <?php else: ?>
            <div class="grid">
                <?php foreach ($products as $p): ?>
                    <div class="product-card">
                        <h3><?php echo htmlspecialchars($p['name']); ?></h3>
                        <p><?php echo htmlspecialchars($p['description']); ?></p>
                        <p class="price">R <?php echo number_format($p['price'], 2); ?></p>
                        <p>In stock: <?php echo (int) $p['stock']; ?></p>
                        <form method="post" action="add_to_cart.php">
                            <input type="hidden" name="product_id" value="<?php echo $p['id']; ?>">
                            <label>Qty <input type="number" name="quantity" value="1" min="1"
                                    max="<?php echo (int) $p['stock']; ?>"></label>
                            <button class="btn" type="submit" <?php echo $p['stock'] <= 0 ? 'disabled' : ''; ?>>Add to
                                cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </main>

    <footer class="site-footer">
        <div class="container">&copy; <?php echo date('Y'); ?> Smart Retail</div>
    </footer>
</body>

</html>