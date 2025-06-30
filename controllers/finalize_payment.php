<?php
require '../connection/connection.php';
require '../models/Booking.php';
require '../models/BookedSeat.php';
require '../models/Payment.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);

$userId = $input['user_id'] ?? null;
$showtimeId = $input['showtime_id'] ?? null;
$seatIds = $input['seat_ids'] ?? [];
$pricePaid = $input['price_paid'] ?? 0;
$paymentMethod = $input['payment_method'] ?? null;

if (!$userId || !$showtimeId || empty($seatIds) || !$paymentMethod) {
  http_response_code(400);
  echo json_encode(['error' => 'Missing required fields']);
  exit;
}

try {
  $conn->beginTransaction();

  // Insert booking
  $bookingId = Booking::create([
    'user_id' => $userId,
    'showtime_id' => $showtimeId,
    'booking_time' => date('Y-m-d H:i:s'),
  ]);

  // Insert booked seats
  foreach ($seatIds as $seatId) {
    BookedSeat::create([
      'booking_id' => $bookingId,
      'showtime_id' => $showtimeId,
      'seat_id' => $seatId
    ]);
  }

  // Insert payment
  Payment::create([
    'booking_id' => $bookingId,
    'amount' => $pricePaid,
    'payment_method' => $paymentMethod,
    'paid_at' => date('Y-m-d H:i:s')
  ]);

  $conn->commit();
  echo json_encode(['success' => true, 'booking_id' => $bookingId]);

} catch (Exception $e) {
  $conn->rollBack();
  http_response_code(500);
  echo json_encode(['error' => 'Transaction failed', 'details' => $e->getMessage()]);
}
