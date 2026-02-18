<?php
// subscribe.php
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address.';
    } else {
        // Basic handling – in a real app you might store this in the database.
        $logFile = __DIR__ . '/subscribers.txt';
        @file_put_contents($logFile, $email . PHP_EOL, FILE_APPEND);

        $message = 'Thank you, you have been subscribed to updates.';
    }
} else {
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Subscription - AMMS</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header class="site-header">
        <div class="container">
            <a href="index.php" class="logo">AMMS</a>
            <nav>
                <a href="index.php">Home</a>
                <a href="products.php">Shop</a>
                <a href="about.php">About</a>
            </nav>
        </div>
    </header>

    <main class="container" style="padding:80px 20px;max-width:700px;margin:80px auto;text-align:center;">
        <?php if ($message): ?>
            <p style="margin-bottom:30px;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <a href="javascript:history.back()" class="btn">Back</a>
    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> AMMS. Power in Simplicity.</p>
            </div>
        </div>
    </footer>
</body>

</html>

