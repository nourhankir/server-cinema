<?php

require '../connection/connection.php';
require '../models/Coupon.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$input = json_decode(file_get_contents("php://input"), true);
$code = $input['code'] ?? null;

if (!$code) {
  http_response_code(400);
  echo json_encode(['success' => false, 'error' => 'Coupon code is required']);
  exit;
}

// Find coupon by code
$coupon = Coupon::where(['code' => $code]);
$coupon = $coupon[0] ?? null;

if (!$coupon) {
  echo json_encode(['success' => false, 'error' => 'Invalid coupon code']);
  exit;
}

// Check expiry
if (!empty($coupon['valid_until']) && strtotime($coupon['valid_until']) < time()) {
  echo json_encode(['success' => false, 'error' => 'Coupon expired']);
  exit;
}

// Respond with discount_percent
echo json_encode([
  'success' => true,
  'discount_percent' => (int) $coupon['discount_percent']
]);
