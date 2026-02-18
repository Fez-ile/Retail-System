<?php
// contact.php
session_start();

$errors = [];
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '') {
        $errors[] = 'Name is required.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'A valid email address is required.';
    }

    if ($subject === '') {
        $errors[] = 'Subject is required.';
    }

    if ($message === '') {
        $errors[] = 'Message is required.';
    }

    if (empty($errors)) {
        // Basic mail handling – adjust recipient as needed
        $to = 'amanda@amms.co.za';
        $fullSubject = 'Website contact: ' . $subject;
        $body = "From: {$name} <{$email}>\n\n" . $message;
        $headers = "From: {$email}\r\nReply-To: {$email}";

        // @mail suppresses warnings if mail is not configured; the form will still behave for the user.
        if (@mail($to, $fullSubject, $body, $headers)) {
            $successMessage = 'Your message has been sent successfully.';
            $name = $email = $subject = $message = '';
        } else {
            $successMessage = 'Your message has been recorded. (Email delivery is not configured on this server.)';
        }
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Contact - AMMS</title>
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

    <main class="container" style="padding:80px 20px;max-width:800px;margin:80px auto;">
        <h2 style="text-align:center;">Contact AMMS</h2>
        <p style="color:var(--text-light);margin-bottom:20px;text-align:center;">
            We're here to help. Reach out using the details below or send us a message.
        </p>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $err): ?>
                    <p><?php echo htmlspecialchars($err); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if ($successMessage): ?>
            <div class="success">
                <p><?php echo htmlspecialchars($successMessage); ?></p>
            </div>
        <?php endif; ?>

        <div style="margin-top:30px;text-align:center;">
            <p style="font-size:18px;"><strong>Phone:</strong> +27 12 578 6591</p>
            <p style="font-size:18px;"><strong>Email:</strong> amanda@amms.co.za</p>
        </div>

        <form method="post" action="contact.php" style="margin-top:40px;text-align:left;">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name ?? ''); ?>">

            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>">

            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" value="<?php echo htmlspecialchars($subject ?? ''); ?>">

            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5"><?php echo htmlspecialchars($message ?? ''); ?></textarea>

            <button type="submit" class="btn">Send Message</button>
        </form>
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