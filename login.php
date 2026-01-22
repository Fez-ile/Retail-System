<?php
// login.php
session_start();
if (isset($_SESSION['user']))
    header('Location: products.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login - Smart Retail</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container auth">
        <h2>Login</h2>
        <?php if (!empty($_SESSION['error'])) {
            echo '<p class="error">' . htmlspecialchars($_SESSION['error']) . '</p>';
            unset($_SESSION['error']);
        } ?>
        <form action="process_login.php" method="post">
            <label>Email<input type="email" name="email" required></label>
            <label>Password<input type="password" name="password" required></label>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>No account? <a href="register.php">Register</a></p>
    </div>
</body>

</html>