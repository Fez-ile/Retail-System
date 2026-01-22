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
    <title>Admin - Manage Products</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body>
    <div class="container">
        <h2>Admin - Products</h2>
        <form action="admin_process_product.php" method="post">
            <h3>Add / Update product</h3>
            <input type="hidden" name="id" value="">
            <label>Name<input name="name" required></label>
            <label>Price<input type="number" name="price" step="0.01" required></label>
            <label>Stock<input type="number" name="stock" required></label>
            <label>Description<textarea name="description"></textarea></label>
            <button class="btn" type="submit">Save</button>
        </form>

        <h3>Existing Products</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Action</th>
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
                                onclick="return confirm('Delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p><a href="../index.php">Back to site</a></p>
    </div>
</body>

</html>