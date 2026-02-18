<?php
// checkout.php
session_start();
require 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    $_SESSION['error'] = 'Cart is empty.';
    header('Location: cart.php');
    exit;
}

// Helper: compute total and gather products (no lock)
$ids = implode(',', array_map('intval', array_keys($cart)));
$res = $mysqli->query("SELECT id,price,stock FROM products WHERE id IN ($ids)");
$products = [];
$total = 0;
while ($r = $res->fetch_assoc()) {
    $pid = $r['id'];
    $qty = $cart[$pid];
    $products[$pid] = $r;
    $total += $qty * $r['price'];
}

// If payment method not selected yet, show payment options
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['payment_method'])) {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Checkout - AMMS</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <header class="site-header">
            <div class="container">
                <a href="index.php" class="logo">AMMS</a>
            </div>
        </header>
        <main class="container" style="padding:60px 20px;">
            <h2>Checkout</h2>
            <p style="color:var(--text-light);">Order subtotal: <strong>R <?php echo number_format($total, 2); ?></strong>
            </p>

            <form method="post" action="checkout.php">
                <h3>Select Payment Method</h3>
                <div style="display:flex;flex-direction:column;gap:12px;max-width:420px;">
                    <label><input type="radio" name="payment_method" value="card" required> Pay by Card</label>
                    <label><input type="radio" name="payment_method" value="paypal"> Pay with PayPal</label>
                    <label><input type="radio" name="payment_method" value="bank"> Bank Transfer</label>
                </div>
                <input type="hidden" name="confirm" value="1">
                <div style="margin-top:20px;">
                    <button class="btn" type="submit">Confirm & Pay</button>
                    <a href="cart.php" class="btn btn-light">Back to Cart</a>
                </div>
            </form>
        </main>
    </body>

    </html>
    <?php
    exit;
}

// At this point payment_method is set; simulate payment and finalize order
$payment = $_POST['payment_method'];

// Begin transaction and finalize order
$mysqli->begin_transaction();
try {
    // lock selected products
    $res = $mysqli->query("SELECT id,price,stock FROM products WHERE id IN ($ids) FOR UPDATE");
    $products_locked = [];
    while ($r = $res->fetch_assoc()) {
        $products_locked[$r['id']] = $r;
    }
    foreach ($cart as $pid => $qty) {
        if (!isset($products_locked[$pid]) || $qty > $products_locked[$pid]['stock']) {
            throw new Exception('Insufficient stock for product ID ' . $pid);
        }
    }

    // create order (note: payment details not stored in DB schema)
    $stmt = $mysqli->prepare("INSERT INTO orders (user_id,total) VALUES (?, ?)");
    $stmt->bind_param('id', $_SESSION['user']['id'], $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmtItem = $mysqli->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?, ?, ?, ?)");
    $stmtUpdate = $mysqli->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($cart as $pid => $qty) {
        $price = $products_locked[$pid]['price'];
        $stmtItem->bind_param('iiid', $order_id, $pid, $qty, $price);
        $stmtItem->execute();
        $stmtUpdate->bind_param('ii', $qty, $pid);
        $stmtUpdate->execute();
    }
    $stmtItem->close();
    $stmtUpdate->close();

    $mysqli->commit();
    unset($_SESSION['cart']);
    $_SESSION['order_success'] = "Order #$order_id placed successfully. Payment method: " . htmlspecialchars($payment);
    header("Location: order_success.php?order_id=$order_id");
    exit;

} catch (Exception $e) {
    $mysqli->rollback();
    $_SESSION['error'] = 'Checkout failed: ' . $e->getMessage();
    header('Location: cart.php');
    exit;
}