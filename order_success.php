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
    <title>Order Success</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <h2>Order Success</h2>
        <?php if ($msg): ?>
            <p class="success"><?php echo htmlspecialchars($msg); ?></p><?php endif; ?>
        <p>Order reference: <strong>#<?php echo $order_id; ?></strong></p>
        <p><a href="products.php">Continue shopping</a></p>
    </div>
</body>

</html>