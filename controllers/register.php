<?php
// controllers/register.php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");


require '../connection/connection.php';
require '../models/User.php';

header('Content-Type: application/json');



$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'] ?? null;
$phone = $data['phone'] ?? null;
$password = $data['password'] ?? '';
$confirm = $data['confirm'] ?? '';
$errors = [];

// Validation
if (!$email && !$phone) $errors[] = "Email or phone is required.";
if ($password !== $confirm) $errors[] = "Passwords do not match.";
if (strlen($password) < 8 || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $errors[] = "Password must be at least 8 characters with one special character.";
}
if (!empty($errors)) {
    http_response_code(422);
    echo json_encode(['errors' => $errors]);
    exit;
}

// Hash password
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Save user
try {
    $userId = User::create([
        'email' => $email,
        'phone' => $phone,
        
        'password' => $hashedPassword
    ]);
    echo json_encode(['success' => true, 'id' => $userId]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Registration failed. Maybe email or phone already exists.']);
}





?>