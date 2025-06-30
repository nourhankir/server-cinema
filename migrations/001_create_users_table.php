<?php
/**
 * Migration: Create users table with full_name, dob, favorite_genre, is_admin
 * Usage: php create_users_table.php
 */

// Include your PDO connection (defines $conn)
require __DIR__ . '/../connection/connection.php';

// SQL to create the users table
$sql = <<<SQL
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(150)  NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(20) NULL UNIQUE
  `full_name` VARCHAR(100) default NULL,
  `dob` DATE default NULL,
  `favorite_genre` VARCHAR(100) DEFAULT NULL,
  `is_admin` TINYINT(1)  DEFAULT 0,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
SQL;

try {
    $conn->exec($sql);
    echo "✅ users table created successfully.\n";
} catch (PDOException $e) {
    die("❌ Migration failed: " . $e->getMessage() . "\n");
}
