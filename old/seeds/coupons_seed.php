<?php
require __DIR__ . '/../connection/connection.php';

$coupons = [
    [
        'code' => 'CHARBEL',
        'discount_percent' => 50,
        'valid_until' => '2029-06-01'
    ]
];

$stmt = $conn->prepare("INSERT IGNORE INTO coupons (code, discount_percent, valid_until) VALUES (:code, :discount, :valid_until)");

foreach ($coupons as $c) {
    $stmt->execute([
        ':code' => $c['code'],
        ':discount' => $c['discount_percent'],
        ':valid_until' => $c['valid_until']
    ]);
}

echo "Coupons table seeded successfully.\n";
?>
