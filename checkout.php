<?php
// checkout.php
session_start();
require 'config.php';

if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

$cart = $_SESSION['cart'] ?? [];
if (empty($cart)) {
    $_SESSION['error'] = 'Cart is empty.';
    header('Location: cart.php');
    exit;
}

// Helper: compute total and gather products (no lock)
$ids = implode(',', array_map('intval', array_keys($cart)));
$res = $mysqli->query("SELECT id,price,stock FROM products WHERE id IN ($ids)");
$products = [];
$total = 0;
while ($r = $res->fetch_assoc()) {
    $pid = $r['id'];
    $qty = $cart[$pid];
    $products[$pid] = $r;
    $total += $qty * $r['price'];
}

// If payment method not selected yet, show payment options
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['payment_method'])) {
    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Checkout - AMMS</title>
        <link rel="icon" type="image/jpeg" href="assets/images/favicon.jpg">
        <link rel="shortcut icon" href="assets/images/favicon.jpg">
        <link rel="stylesheet" href="css/style.css">
        <script src="js/scripts.js" defer></script>
    </head>

    <body>
        <header class="site-header">
            <div class="container">
                <a href="index.php" class="logo">AMMS</a>
            </div>
        </header>
        <main class="container" style="padding:60px 20px; max-width: 800px;">
            <h2 style="text-align: center; margin-bottom: 8px; font-size: 32px; font-weight: 700;">Checkout</h2>
            <p style="text-align: center; color: #6b7280; margin-bottom: 40px; font-size: 16px;">
                Order subtotal: <strong style="color: #111827;">R <?php echo number_format($total, 2); ?></strong>
            </p>

            <form method="post" action="checkout.php" class="checkout-form">
                <!-- Payment Method Selection -->
                <div class="payment-methods-section">
                    <h3 class="section-title">Payment Method</h3>

                    <div class="payment-methods-grid">
                        <!-- Pay with Card - Active -->
                        <label class="payment-method-card active" for="payment_card">
                            <input type="radio" id="payment_card" name="payment_method" value="card" checked>
                            <div class="payment-method-content">
                                <div class="payment-method-icon">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect x="2" y="5" width="20" height="14" rx="3" stroke="currentColor"
                                            stroke-width="2" />
                                        <line x1="2" y1="9" x2="22" y2="9" stroke="currentColor" stroke-width="1" />
                                        <line x1="6" y1="13" x2="10" y2="13" stroke="currentColor" stroke-width="1" />
                                        <line x1="12" y1="13" x2="18" y2="13" stroke="currentColor" stroke-width="1" />
                                    </svg>
                                </div>
                                <div class="payment-method-text">
                                    <span class="payment-method-name">Pay with Card</span>
                                    <span class="payment-method-desc">Visa, Mastercard, Amex</span>
                                </div>
                            </div>
                        </label>

                        <!-- PayPal - Coming Soon -->
                        <div class="payment-method-card coming-soon">
                            <div class="payment-method-content">
                                <div class="payment-method-icon paypal-icon">
                                    <img src="https://www.paypalobjects.com/webstatic/icon/pp258.png" alt="PayPal logo">
                                </div>
                                <div class="payment-method-text">
                                    <span class="payment-method-name">PayPal</span>
                                    <span class="payment-method-desc">Coming Soon</span>
                                </div>
                            </div>
                            <div class="coming-soon-badge">Coming Soon</div>
                        </div>

                        <!-- Payflex - Coming Soon -->
                        <div class="payment-method-card coming-soon">
                            <div class="payment-method-content">
                                <div class="payment-method-icon payflex-icon">
                                    <img src="https://payflex.co.za/favicon.ico" alt="Payflex logo">
                                </div>
                                <div class="payment-method-text">
                                    <span class="payment-method-name">Payflex</span>
                                    <span class="payment-method-desc">Coming Soon</span>
                                </div>
                            </div>
                            <div class="coming-soon-badge">Coming Soon</div>
                        </div>
                    </div>
                </div>

                <!-- Card Payment Form -->
                <div class="card-payment-section" id="cardPaymentSection">
                    <div class="card-form-container">
                        <div class="card-form-header">
                            <h4>Card Information</h4>
                            <div class="card-brands">
                                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons@v9/icons/visa.svg"
                                    alt="Visa" class="card-brand-icon">
                                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons@v9/icons/mastercard.svg"
                                    alt="Mastercard" class="card-brand-icon">
                                <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons@v9/icons/americanexpress.svg"
                                    alt="American Express" class="card-brand-icon">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" id="cardNumber" name="card_number" placeholder="1234 1234 1234 1234"
                                maxlength="19" required>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiryDate">Expiry Date</label>
                                <input type="text" id="expiryDate" name="card_expiry" placeholder="MM/YY" maxlength="5"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="cvv">CVV</label>
                                <input type="text" id="cvv" name="card_cvc" placeholder="123" maxlength="4" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cardholderName">Cardholder Name</label>
                            <input type="text" id="cardholderName" name="cardholder_name" placeholder="Full name on card"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="billingCountry">Country or Region</label>
                            <input type="text" id="billingCountry" name="card_country" placeholder="Country or region"
                                required>
                        </div>
                    </div>
                </div>

                <!-- Security Message -->
                <div class="security-notice">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L3 7V17L12 22L21 17V7L12 2Z" stroke="#10B981" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9 12L11 14L15 10" stroke="#10B981" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    <span>Secure payment encrypted checkout</span>
                </div>

                <!-- Action Buttons -->
                <div class="checkout-actions">
                    <button type="submit" class="pay-now-btn">Pay Now</button>
                    <a href="cart.php" class="back-to-cart-btn">Back to Cart</a>
                </div>
            </form>
        </main>
    </body>

    </html>
    <?php
    exit;
}

// At this point payment_method is set; simulate payment and finalize order
$payment = $_POST['payment_method'];

// Begin transaction and finalize order
$mysqli->begin_transaction();
try {
    // lock selected products
    $res = $mysqli->query("SELECT id,price,stock FROM products WHERE id IN ($ids) FOR UPDATE");
    $products_locked = [];
    while ($r = $res->fetch_assoc()) {
        $products_locked[$r['id']] = $r;
    }
    foreach ($cart as $pid => $qty) {
        if (!isset($products_locked[$pid]) || $qty > $products_locked[$pid]['stock']) {
            throw new Exception('Insufficient stock for product ID ' . $pid);
        }
    }

    // create order (note: payment details not stored in DB schema)
    $stmt = $mysqli->prepare("INSERT INTO orders (user_id,total) VALUES (?, ?)");
    $stmt->bind_param('id', $_SESSION['user']['id'], $total);
    $stmt->execute();
    $order_id = $stmt->insert_id;
    $stmt->close();

    $stmtItem = $mysqli->prepare("INSERT INTO order_items (order_id,product_id,quantity,price) VALUES (?, ?, ?, ?)");
    $stmtUpdate = $mysqli->prepare("UPDATE products SET stock = stock - ? WHERE id = ?");
    foreach ($cart as $pid => $qty) {
        $price = $products_locked[$pid]['price'];
        $stmtItem->bind_param('iiid', $order_id, $pid, $qty, $price);
        $stmtItem->execute();
        $stmtUpdate->bind_param('ii', $qty, $pid);
        $stmtUpdate->execute();
    }
    $stmtItem->close();
    $stmtUpdate->close();

    $mysqli->commit();
    unset($_SESSION['cart']);
    $_SESSION['order_success'] = "Order #$order_id placed successfully. Payment method: " . htmlspecialchars($payment);
    header("Location: order_success.php?order_id=$order_id");
    exit;

} catch (Exception $e) {
    $mysqli->rollback();
    $_SESSION['error'] = 'Checkout failed: ' . $e->getMessage();
    header('Location: cart.php');
    exit;
}
