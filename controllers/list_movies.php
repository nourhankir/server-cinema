<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');
require '../connection/connection.php';
require '../models/Movie.php';
try{
    $movies = Movie::all();
    
    echo json_encode($movies);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to fetch movies.']);
}





?>