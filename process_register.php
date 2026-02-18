<?php
// process_register.php
session_start();
require 'config.php';

$fullname = trim($_POST['fullname'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!$fullname || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    $_SESSION['error'] = 'Please provide valid details.';
    header('Location: register.php');
    exit;
}

// check if email exists
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    $_SESSION['error'] = 'Email already taken.';
    $stmt->close();
    header('Location: register.php');
    exit;
}
$stmt->close();

// insert user
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("INSERT INTO users (fullname,email,password) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $fullname, $email, $hash);
if ($stmt->execute()) {
    $_SESSION['user'] = ['id' => $stmt->insert_id, 'fullname' => $fullname, 'email' => $email, 'role' => 'customer'];
    $stmt->close();
    header('Location: products.php');
    exit;
} else {
    $stmt->close();
    $_SESSION['error'] = 'Registration failed. Try again.';
    header('Location: register.php');
    exit;
}
