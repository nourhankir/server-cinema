<?php
require __DIR__ . '/../connection/connection.php';

$rows = range('A', 'K');  // A to K (11 rows)
$cols = range(1, 10);     // 1 to 10 seats per row

$stmt = $conn->prepare("INSERT IGNORE INTO seats (seat_code) VALUES (:code)");

foreach ($rows as $row) {
    foreach ($cols as $col) {
        $code = $row . $col;
        $stmt->execute([':code' => $code]);
    }
}

echo "Seats table seeded with 110 seats.\n";
?>