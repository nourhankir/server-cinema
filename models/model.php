<?php


require '../connection/connection.php';

abstract class Model
{
    
    protected static $table;

    
    protected static function db(): PDO
{
    global $conn;
    return $conn;
}


    
    public static function all(): array
    {
        $stmt = static::db()->query("SELECT * FROM " . static::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public static function where(array $conditions): array {
        $sql = "SELECT * FROM " . static::$table . " WHERE ";
        $sql .= implode(' AND ', array_map(fn($col) => "$col = :$col", array_keys($conditions)));

        $stmt = static::db()->prepare($sql);
        $stmt->execute($conditions);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

  
    public static function find($id)
    {
        $stmt = static::db()->prepare("SELECT * FROM " . static::$table . " WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public static function create(array $data): string
    {
        $columns = array_keys($data);
        $placeholders = array_map(fn($col) => ':' . $col, $columns);
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            static::$table,
            implode(', ', $columns),
            implode(', ', $placeholders)
        );
        $stmt = static::db()->prepare($sql);
        $stmt->execute($data);
        return static::db()->lastInsertId();
    }

    
    public static function update($id, array $data): bool
    {
        $columns = array_keys($data);
        $assigns = array_map(fn($col) => "$col = :$col", $columns);
        $sql = sprintf(
            "UPDATE %s SET %s WHERE id = :id",
            static::$table,
            implode(', ', $assigns)
        );
        $stmt = static::db()->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    
    public static function delete($id): bool
    {
        $stmt = static::db()->prepare("DELETE FROM " . static::$table . " WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
    public static function findByIdentifier(string $identifier)
{
    $stmt = static::db()->prepare("SELECT * FROM users WHERE email = :id OR phone = :id LIMIT 1");
    $stmt->execute(['id' => $identifier]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
?>