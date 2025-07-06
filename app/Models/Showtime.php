<?php

require_once(__DIR__ . '/../Core/Model.php');


class Showtime extends Model {
    protected static string $table = 'showtimes';
    protected static string $primaryKey = 'id';
    public static function getByMovieId(PDO $conn, int $movieId): array {
    $sql = "
        SELECT 
            s.id,
            s.movie_id,
            s.auditorium_id,
            s.show_date,
            s.show_time,
            a.name AS auditorium_name,
            a.price
        FROM showtimes s
        JOIN auditoriums a ON s.auditorium_id = a.id
        WHERE s.movie_id = :movie_id
        ORDER BY s.show_date, s.show_time
    ";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':movie_id' => $movieId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

   
}




?>