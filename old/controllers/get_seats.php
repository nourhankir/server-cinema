<?php
require '../connection/connection.php';
require '../models/Seat.php';
require '../models/Showtime.php';
require '../models/BookedSeat.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$showtimeId = $_GET['showtime_id'] ?? null;

if (!$showtimeId) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing showtime_id']);
  exit;
}

// Get auditorium_id from showtime model
$showtime = Showtime::find($showtimeId);
if (!$showtime) {
  http_response_code(404);
  echo json_encode(['error' => 'Showtime not found']);
  exit;
}

$auditoriumId = $showtime['auditorium_id'];

// Get all seats for the auditorium
$seats = Seat::all();


// Get booked seats for this showtime
$bookedSeats = BookedSeat::where(['showtime_id' => $showtimeId]);
$bookedSeatIds = array_column($bookedSeats, 'seat_id');

// Mark seats as booked
foreach ($seats as &$seat) {
  $seat['is_booked'] = in_array($seat['id'], $bookedSeatIds);
}

echo json_encode($seats);
