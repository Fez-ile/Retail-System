<?php
// add_to_cart.php
session_start();
require 'config.php';

$product_id = (int) ($_POST['product_id'] ?? 0);
$quantity = max(1, (int) ($_POST['quantity'] ?? 1));

// check product exists and stock
$stmt = $mysqli->prepare("SELECT stock FROM products WHERE id = ?");
$stmt->bind_param('i', $product_id);
$stmt->execute();
$stmt->bind_result($stock);
if (!$stmt->fetch()) {
    $stmt->close();
    $_SESSION['error'] = 'Product not found.';
    header('Location: products.php');
    exit;
}
$stmt->close();

if ($quantity > $stock) {
    $_SESSION['error'] = 'Requested quantity exceeds stock.';
    header('Location: products.php');
    exit;
}

// add to session cart: cart[product_id] = quantity
if (!isset($_SESSION['cart']))
    $_SESSION['cart'] = [];
if (isset($_SESSION['cart'][$product_id])) {
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    $_SESSION['cart'][$product_id] = $quantity;
}

$_SESSION['message'] = 'Added to cart.';
header('Location: products.php');
exit;
