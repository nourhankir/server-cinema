<?php

require '../connection/connection.php';

$sql = <<<SQL
CREATE TABLE IF NOT EXISTS movies (
  id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  poster_url VARCHAR(255),
  genre VARCHAR(100),
  rating VARCHAR(10),
  cast TEXT,
  is_featured TINYINT(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

try {
  $conn->exec($sql);
  echo "✅ movies table created successfully.";
} catch (PDOException $e) {
  echo "❌ Error creating table: " . $e->getMessage();
}
?>
