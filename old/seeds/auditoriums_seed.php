<?php
require __DIR__ . '/../connection/connection.php';

$auditoriums = [
    ['name' => 'vox', 'price' => 10],
    ['name' => 'gold', 'price' => 15],
];

$stmt = $conn->prepare("INSERT IGNORE INTO auditoriums (name, price) VALUES (:name, :price)");

foreach ($auditoriums as $a) {
    $stmt->execute([
        ':name' => $a['name'],
        ':price' => $a['price']
    ]);
}

echo "Auditoriums table seeded with initial data.\n";
?>
