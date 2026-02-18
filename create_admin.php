<?php
// create_admin.php
// One-off script to create an admin user. Run locally and delete when done.
// Usage: open in browser, fill details and submit. Then delete this file.

require 'config.php';

if (php_sapi_name() !== 'cli') {
    // simple HTML form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fullname = trim($_POST['fullname'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (!$fullname || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
            $error = 'Please provide valid details (password >= 6 chars).';
        } else {
            // check existing
            $stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = 'Email already exists.';
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $mysqli->prepare("INSERT INTO users (fullname,email,password,role) VALUES (?, ?, ?, 'admin')");
                $stmt->bind_param('sss', $fullname, $email, $hash);
                if ($stmt->execute()) {
                    $success = 'Admin created. Please delete create_admin.php now.';
                } else {
                    $error = 'Database error: could not create admin.';
                }
            }
        }
    }

    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Create Admin</title>
        <link rel="stylesheet" href="css/style.css">
    </head>

    <body>
        <div class="container auth">
            <h2>Create Admin (one-time)</h2>
            <?php if (!empty($error)): ?>
                <p class="error"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
            <?php if (!empty($success)): ?>
                <p class="success"><?php echo htmlspecialchars($success); ?></p>
            <?php else: ?>
                <form method="post">
                    <label>Full name<input type="text" name="fullname" required></label>
                    <label>Email<input type="email" name="email" required></label>
                    <label>Password<input type="password" name="password" required minlength="6"></label>
                    <button class="btn" type="submit">Create Admin</button>
                </form>
            <?php endif; ?>
            <p><a href="index.php">Back</a></p>
        </div>
    </body>

    </html>
    <?php
    exit;
}

// CLI usage: php create_admin.php name email password
if ($argc < 4) {
    echo "Usage: php create_admin.php \"Full Name\" email@example.com password\n";
    exit(1);
}
$fullname = $argv[1];
$email = $argv[2];
$password = $argv[3];
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6) {
    echo "Invalid email or password too short.\n";
    exit(1);
}
$stmt = $mysqli->prepare("SELECT id FROM users WHERE email = ?");
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo "Email already exists.\n";
    exit(1);
}
$hash = password_hash($password, PASSWORD_DEFAULT);
$stmt = $mysqli->prepare("INSERT INTO users (fullname,email,password,role) VALUES (?, ?, ?, 'admin')");
$stmt->bind_param('sss', $fullname, $email, $hash);
if ($stmt->execute()) {
    echo "Admin created (id: " . $stmt->insert_id . "). Delete create_admin.php now.\n";
} else {
    echo "Failed to create admin.\n";
}
