<?php
// process_login.php
session_start();
require 'config.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || !$password) {
    $_SESSION['error'] = 'Invalid credentials.';
    header('Location: login.php');
    exit;
}

$stmt = $mysqli->prepare("SELECT id,fullname,password,role FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->bind_result($id, $fullname, $hash, $role);
if ($stmt->fetch() && password_verify($password, $hash)) {
    $_SESSION['user'] = ['id' => $id, 'fullname' => $fullname, 'email' => $email, 'role' => $role];
    $stmt->close();
    header('Location: products.php');
    exit;
} else {
    $stmt->close();
    $_SESSION['error'] = 'Login failed.';
    header('Location: login.php');
    exit;
}
