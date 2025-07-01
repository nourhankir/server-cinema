<?php
require __DIR__ . '/../connection/connection.php';

$showtimes = [
    
    ['movie_id' => 1, 'auditorium_id' => 1, 'show_date' => '2025-06-02', 'show_time' => '00:00:00'],
    ['movie_id' => 2, 'auditorium_id' => 1, 'show_date' => '2025-06-30', 'show_time' => '16:14:49'],
    ['movie_id' => 3, 'auditorium_id' => 2, 'show_date' => '2025-06-30', 'show_time' => '16:14:49'],
    ['movie_id' => 4, 'auditorium_id' => 1, 'show_date' => '2025-07-02', 'show_time' => '14:00:00'],
    ['movie_id' => 5, 'auditorium_id' => 2, 'show_date' => '2025-07-02', 'show_time' => '18:00:00'],
    ['movie_id' => 6, 'auditorium_id' => 1, 'show_date' => '2025-07-03', 'show_time' => '20:30:00'],
    ['movie_id' => 7, 'auditorium_id' => 2, 'show_date' => '2025-07-04', 'show_time' => '22:00:00'],
    ['movie_id' => 8, 'auditorium_id' => 1, 'show_date' => '2025-07-05', 'show_time' => '12:30:00'],
    ['movie_id' => 9, 'auditorium_id' => 2, 'show_date' => '2025-07-06', 'show_time' => '19:00:00']
];

$stmt = $conn->prepare("INSERT IGNORE INTO showtimes (movie_id, auditorium_id, show_date, show_time) 
                        VALUES (:movie_id, :auditorium_id, :show_date, :show_time)");

foreach ($showtimes as $s) {
    $stmt->execute([
        ':movie_id' => $s['movie_id'],
        ':auditorium_id' => $s['auditorium_id'],
        ':show_date' => $s['show_date'],
        ':show_time' => $s['show_time']
    ]);
}

echo "Showtimes table seeded successfully.\n";
?>
