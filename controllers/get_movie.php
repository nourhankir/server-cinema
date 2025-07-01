<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require '../connection/connection.php';
require '../models/Movie.php';

$id = $_GET['id'] ?? null;

if (!$id) {
  http_response_code(400);
  echo json_encode(['error' => 'Movie ID is required']);
  exit;
}

$movie=Movie::find($id);

if ($movie) {
  echo json_encode($movie);
} else {
  http_response_code(404);
  echo json_encode(['error' => 'Movie not found']);
}
