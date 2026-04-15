<?php
// admin/admin.php
session_start();
require '../config.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

// fetch products
$res = $mysqli->query("SELECT id,name,price,stock FROM products ORDER BY id DESC");
$products = $res->fetch_all(MYSQLI_ASSOC);
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Admin Dashboard - AMMS</title>
    <link rel="icon" type="image/jpeg" href="../assets/images/favicon.jpg">
    <link rel="shortcut icon" href="../assets/images/favicon.jpg">
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <!-- HEADER -->
    <header class="site-header">
        <div class="container">
            <a href="../index.php" class="logo">AMMS</a>
            <nav>
                <a href="../index.php">Home</a>
                <a href="../products.php">Shop</a>
                <a href="admin.php">Admin</a>
                <a href="../logout.php">Logout</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding:60px 0;">
        <h2 style="font-family:var(--serif);font-size:42px;margin-bottom:40px;">Product Management</h2>

        <!-- ADD / UPDATE FORM -->
        <form action="admin_process_products.php" method="post"
            style="background:var(--secondary-bg);padding:40px;margin-bottom:60px;">
            <h3 style="font-family:var(--serif);font-size:24px;margin-bottom:30px;">Add or Update Product</h3>

            <input type="hidden" name="id" value="">

            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Price (R)</label>
                <input type="number" name="price" step="0.01" required>
            </div>

            <div class="form-group">
                <label>Stock Quantity</label>
                <input type="number" name="stock" required>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4" style="resize:vertical;"></textarea>
            </div>

            <button class="btn" type="submit" style="width:100%;">Save Product</button>
        </form>

        <!-- PRODUCTS TABLE -->
        <h3 style="font-family:var(--serif);font-size:24px;margin-bottom:30px;">Manage Products</h3>

        <?php if (count($products) === 0): ?>
            <p class="notice">No products yet. Add one above to get started.</p>
        <?php else: ?>
            <div style="overflow-x:auto;">
                <table style="margin-bottom:40px;">
                    <thead>
                        <tr>
                            <th style="width:10%;">ID</th>
                            <th style="width:35%;">Name</th>
                            <th style="width:15%;">Price</th>
                            <th style="width:15%;">Stock</th>
                            <th style="width:25%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $p): ?>
                            <tr>
                                <td><?php echo $p['id']; ?></td>
                                <td><?php echo htmlspecialchars($p['name']); ?></td>
                                <td>R <?php echo number_format($p['price'], 2); ?></td>
                                <td><?php echo (int) $p['stock']; ?></td>
                                <td>
                                    <a href="admin_delete_product.php?id=<?php echo $p['id']; ?>"
                                        onclick="return confirm('Are you sure? This cannot be undone.')"
                                        style="color:var(--text-dark);text-decoration:underline;font-size:12px;">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>

        <div style="text-align:center;padding:40px 0;border-top:1px solid var(--border-light);">
            <a href="../index.php"
                style="color:var(--text-light);text-decoration:none;font-size:12px;letter-spacing:1px;text-transform:uppercase;">←
                Back to Site</a>
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>Admin</h4>
                    <ul>
                        <li><a href="admin.php">Dashboard</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>AMMS</h4>
                    <ul>
                        <li><a href="../index.php">Home</a></li>
                        <li><a href="../products.php">Shop</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Account</h4>
                    <ul>
                        <li><a href="../logout.php">Logout</a></li>
                    </ul>
                </div>
                <div class="footer-section"></div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity.</p>
            </div>
        </div>
    </footer>
</body>

</html>
