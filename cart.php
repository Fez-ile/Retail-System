<?php
// cart.php
session_start();
require 'config.php';

$cart = $_SESSION['cart'] ?? [];
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
    <title>Cart - Smart Retail</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Your Cart</h2>
        <?php if (!$items): ?>
            <p>Your cart is empty. <a href="products.php">Browse products</a></p>
        <?php else: ?>
            <table class="cart">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($it['name']); ?></td>
                            <td>R <?php echo number_format($it['price'], 2); ?></td>
                            <td><?php echo (int) $it['qty']; ?></td>
                            <td>R <?php echo number_format($it['subtotal'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p class="total">Total: R <?php echo number_format($total, 2); ?></p>
            <?php if (isset($_SESSION['user'])): ?>
                <form method="post" action="checkout.php"><button class="btn">Proceed to Checkout</button></form>
            <?php else: ?>
                <p>Please <a href="login.php">login</a> or <a href="register.php">register</a> to checkout.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>

</html>