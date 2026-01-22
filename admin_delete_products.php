<?php
// admin/admin_delete_product.php
session_start();
require '../config.php';
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header('Location: ../login.php');
    exit;
}
$id = (int) ($_GET['id'] ?? 0);
if ($id > 0) {
    $stmt = $mysqli->prepare("DELETE FROM products WHERE id = ?");
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
}
header('Location: admin.php');
