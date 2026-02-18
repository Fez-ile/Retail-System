<?php
// admin/admin_process_product.php
session_start();
require '../config.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}

$id = (int) ($_POST['id'] ?? 0);
$name = trim($_POST['name'] ?? '');
$price = (float) ($_POST['price'] ?? 0);
$stock = (int) ($_POST['stock'] ?? 0);
$description = trim($_POST['description'] ?? '');

if (!$name || $price <= 0) {
    $_SESSION['error'] = 'Invalid input.';
    header('Location: admin.php');
    exit;
}

if ($id > 0) {
    $stmt = $mysqli->prepare("UPDATE products SET name=?, description=?, price=?, stock=? WHERE id=?");
    $stmt->bind_param('ssddi', $name, $description, $price, $stock, $id);
    $stmt->execute();
    $stmt->close();
} else {
    $stmt = $mysqli->prepare("INSERT INTO products (name, description, price, stock) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('ssdi', $name, $description, $price, $stock);
    $stmt->execute();
    $stmt->close();
}
header('Location: admin.php');
