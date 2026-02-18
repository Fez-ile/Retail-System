<?php
// import_products.php
// Run this from the browser or CLI to insert AMMS product list if they don't already exist.
require 'config.php';

$products = [
    ['Signature Tailored Blazer', 'Structured black blazer with a sharp silhouette.', 3499.00, 8],
    ['Classic White Overshirt', 'Premium cotton overshirt with a relaxed fit.', 1799.00, 12],
    ['Structured Black Trousers', 'Tailored straight-leg trousers with refined detailing.', 2199.00, 10],
    ['Minimal Crewneck Tee', 'Heavyweight cotton tee with a clean finish.', 899.00, 30],
    ['Longline Wool Coat', 'Statement outerwear with a timeless cut.', 4999.00, 5],
    ['Monochrome Knit Sweater', 'Soft knit with a minimalist silhouette.', 1699.00, 14],
    ['Relaxed Tailored Shirt', 'Versatile essential with structured lines.', 1599.00, 18],
    ['Wide-Leg Tailored Pants', 'Fluid silhouette with elevated tailoring.', 2299.00, 9],
    ['Essential Zip Hoodie', 'Premium fabric with subtle structure.', 1499.00, 20],
    ['Slim Fit Black Jeans', 'Clean-cut denim with a modern edge.', 1899.00, 16],
    ['Oversized Wool Scarf', 'Soft wool accessory in monochrome tones.', 999.00, 25],
    ['Structured Leather Belt', 'Minimal hardware with premium finish.', 799.00, 40],
    ['Classic White Sneakers', 'Minimal leather sneakers with sleek detailing.', 2499.00, 7],
    ['Black Leather Loafers', 'Refined silhouette with polished finish.', 2899.00, 6],
    ['Cropped Utility Jacket', 'Structured jacket with modern edge.', 2699.00, 11],
    ['Ribbed Tank Top', 'Fitted essential with clean lines.', 699.00, 28],
    ['Tailored Shorts', 'Sharp-cut shorts with refined structure.', 1399.00, 13],
    ['Minimalist Crossbody Bag', 'Compact design with smooth leather texture.', 1999.00, 10],
    ['Structured Tote Bag', 'Spacious tote with architectural shape.', 2799.00, 6],
    ['Lightweight Running Shoes', 'Breathable design with modern comfort.', 2199.00, 15],
];

$inserted = 0;
foreach ($products as $p) {
    $name = $p[0];
    $desc = $p[1];
    $price = $p[2];
    $stock = $p[3];

    // check exists
    $stmt = $mysqli->prepare("SELECT id FROM products WHERE name = ? LIMIT 1");
    $stmt->bind_param('s', $name);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows === 0) {
        $stmt->close();
        $ins = $mysqli->prepare("INSERT INTO products (name,description,price,stock,created_at) VALUES (?, ?, ?, ?, NOW())");
        $ins->bind_param('ssdi', $name, $desc, $price, $stock);
        if ($ins->execute())
            $inserted++;
        $ins->close();
    } else {
        $stmt->close();
    }
}

echo "Import complete. Products inserted: $inserted\n";
?>