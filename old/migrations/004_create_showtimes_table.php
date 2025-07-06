<?php
require '../connection/connection.php';

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS showtimes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  movie_id INT NOT NULL,
  auditorium_id INT unsigned NOT NULL,
  show_date DATE NOT NULL,
  show_time TIME NOT NULL,
 
  FOREIGN KEY (movie_id) REFERENCES movies(id) ON DELETE CASCADE,
  FOREIGN KEY (auditorium_id) REFERENCES auditoriums(id) ON DELETE CASCADE
) ENGINE=InnoDB; DEFAULT CHARSET=utf8mb4;
SQL;

try {
  $conn->exec($sql);
  echo "✅ showtimes table created successfully.";
} catch (PDOException $e) {
  echo "❌ Error creating showtimes table: " . $e->getMessage();
}
