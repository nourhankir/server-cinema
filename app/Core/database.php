<?php

class Database {
    public static function connect(): PDO {
        $config = $config = require __DIR__ . '/../../Config/database.php';


        try {
            $conn = new PDO(
                "mysql:host={$config['host']};dbname={$config['database']};charset=utf8",
                $config['user'],
                $config['password']
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn; 
        } catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed', 'details' => $e->getMessage()]);

    exit;
}

    }
}

