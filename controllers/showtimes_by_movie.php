<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require '../connection/connection.php';

$movie_id = $_GET['movie_id'] ?? null;

if (!$movie_id) {
  http_response_code(400);
  echo json_encode(['error' => 'movie_id is required']);
  exit;
}

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
  WHERE s.movie_id = ?
  ORDER BY s.show_date, s.show_time
";

$stmt = $conn->prepare($sql);
$stmt->execute([$movie_id]);

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
