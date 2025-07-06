<?php
abstract class Model{
    protected static string $table;
    protected static string $primaryKey = 'id';

    public static function all(PDO $conn): array {
    try {
        $sql = "SELECT * FROM " . static::$table;
        $stmt = $conn->query($sql);

        if ($stmt) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return []; 
    } catch (PDOException $e) {
        
        error_log("Database error: " . $e->getMessage());
        return []; 
    }
}


public static function find(PDO $conn, int $id): ?array {

    try {
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :id",
            static::$table,
            static::$primaryKey
        );

        $stmt = $conn->prepare($sql);
        $stmt->execute([':id' => $id]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ?: null; 
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return null;
    }
}


public static function create(PDO $conn, array $data): bool {
    try {
        $columns = array_keys($data);                 // ['email', 'phone', 'password']
        $fields = implode(', ', $columns);            // "email, phone, password"
        $placeholders = ':' . implode(', :', $columns); // ":email, :phone, :password"

        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            $fields,
            $placeholders
        );

        $stmt = $conn->prepare($sql);
        return $stmt->execute($data); 

    } catch (PDOException $e) {
        error_log("Insert error: " . $e->getMessage());
        return false;
    }
}

public static function update(PDO $conn, int $id, array $data): bool {
    try {
        $columns = array_keys($data); // ['email', 'phone']
        
        // Build SET part like: "email = :email, phone = :phone"
        $setClause = implode(', ', array_map(fn($col) => "$col = :$col", $columns));

        $sql = sprintf(
            "UPDATE %s SET %s WHERE %s = :id",
            static::$table,
            $setClause,
            static::$primaryKey
        );

        $stmt = $conn->prepare($sql);

        
        $data['id'] = $id;

        return $stmt->execute($data);
    } catch (PDOException $e) {
        error_log("Update error: " . $e->getMessage());
        return false;
    }
}

public static function delete(PDO $conn, int $id): bool {
    try {
        $sql = sprintf(
            "DELETE FROM %s WHERE %s = :id",
            static::$table,
            static::$primaryKey
        );

        $stmt = $conn->prepare($sql);
        return $stmt->execute([':id' => $id]); 

    } catch (PDOException $e) {
        error_log("Delete error: " . $e->getMessage());
        return false;
    }
}
public static function where(PDO $conn, string $column, mixed $value): array {
    try {
        $sql = sprintf(
            "SELECT * FROM %s WHERE %s = :value",
            static::$table,
            $column
        );

        $stmt = $conn->prepare($sql);
        $stmt->execute([':value' => $value]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Where error: " . $e->getMessage());
        return [];
    }
}






}




?>