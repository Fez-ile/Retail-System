<?php
// register.php
session_start();
if (isset($_SESSION['user']))
    header('Location: products.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register - Smart Retail</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/scripts.js" defer></script>
</head>

<body>
    <div class="container auth">
        <h2>Register</h2>
        <form id="registerForm" action="process_register.php" method="post" novalidate>
            <label>Full name<input type="text" name="fullname" required></label>
            <label>Email<input type="email" name="email" required></label>
            <label>Password<input type="password" name="password" required minlength="6"></label>
            <button type="submit" class="btn">Register</button>
        </form>
        <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
</body>

</html>