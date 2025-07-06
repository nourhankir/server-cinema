<?php

require_once(__DIR__ . '/../Core/Model.php');


class User extends Model {
    protected static string $table = 'users';
    protected static string $primaryKey = 'id';
    public static function findByIdentifier(PDO $conn, string $identifier): ?array {
    try {
        $sql = "SELECT * FROM users WHERE email = :id OR phone = :id LIMIT 1";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $identifier);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ?: null;
    } catch (PDOException $e) {
        error_log("Login lookup failed: " . $e->getMessage());
        return null;
    }
}
}




?>