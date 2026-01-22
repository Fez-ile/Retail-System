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

// fetch product data and compute total; use transaction
$mysqli->begin_transaction();

try {
    $ids = implode(',', array_map('intval', array_keys($cart)));
    $res = $mysqli->query("SELECT id,price,stock FROM products WHERE id IN ($ids) FOR UPDATE");
    $products = [];
    $total = 0;
    while ($r = $res->fetch_assoc()) {
        $pid = $r['id'];
        $qty = $cart[$pid];
        if ($qty > $r['stock'])
            throw new Exception('Insufficient stock for product ID ' . $pid);
        $products[$pid] = $r;
        $total += $qty * $r['price'];
    }

    // create order
    $stmt = $mysqli->prepare("INSERT INTO orders (user_id,total) VALUES (?, ?)");
    $stmt->bind_param('id', $_SESSION['user']['id'], $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    // insert order_items and update stock
    $stmtItem = $mysqli->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?, ?, ?, ?)");
    $stmtUpdate = $mysqli->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($cart as $pid => $qty) {
        $price = $products[$pid]['price'];
        $stmtItem->bind_param('iiid', $order_id, $pid, $qty, $price);
        $stmtItem->execute();
        $stmtUpdate->bind_param('ii', $qty, $pid);
        $stmtUpdate->execute();
    }
    $stmtItem->close();
    $stmtUpdate->close();

    $mysqli->commit();
    // clear cart
    unset($_SESSION['cart']);
    $_SESSION['order_success'] = "Order #$order_id placed successfully.";
    header("Location: order_success.php?order_id=$order_id");
    exit;

} catch (Exception $e) {
    $mysqli->rollback();
    $_SESSION['error'] = 'Checkout failed: ' . $e->getMessage();
    header('Location: cart.php');
    exit;
}
