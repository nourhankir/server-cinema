<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");

header('Content-Type: application/json');

require '../connection/connection.php';
require '../models/User.php';

$data = json_decode(file_get_contents('php://input'), true);

$identifier = $data['identifier'] ?? '';
$password = $data['password'] ?? '';

$errors = [];

// Basic validation
if (empty($identifier) || empty($password)) {
    $errors[] = "Email/Phone and password are required.";
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
    exit;
}

// Try to find user by email or phone
$user = User::findByIdentifier($identifier);

if (!$user || !password_verify($password, $user['password'])) {
    http_response_code(401);
    echo json_encode(['error' => 'Invalid credentials.']);
    exit;
}

// Success
echo json_encode([
    'success' => true,
    'user' => [
        'id' => $user['id'],
        'email' => $user['email'],
        'phone' => $user['phone'],
        'full_name' => $user['full_name'],
        'is_admin' => $user['is_admin']
    ]
]);
?>