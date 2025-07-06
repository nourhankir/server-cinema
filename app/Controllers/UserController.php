<?php
require __DIR__ . '/../Core/Controller.php';
require __DIR__ . '/../Models/User.php';
class UserController extends Controller{


    public  function index($request){
        $db = Database::connect();
        $users=User::all($db);
        Response::json($users);
    }

    public function login($request) {
    $data = $request->input();

    $identifier = $data['identifier'] ?? '';
    $password = $data['password'] ?? '';
    $errors = [];

    if (empty($identifier) || empty($password)) {
        return $this->error("Email/Phone and password are required.", 422);
    }

    
    $user = User::findByIdentifier($this->db, $identifier);

    if (!$user || !password_verify($password, $user['password'])) {
        return $this->error("Invalid credentials.", 401);
    }

    
    $this->response([
        'success' => true,
        'user' => [
            'id' => $user['id'],
            'email' => $user['email'],
            'phone' => $user['phone'],
            'full_name' => $user['full_name'],
            'is_admin' => $user['is_admin'],
        ]
    ]);
}
public function register($request) {
    $data = $request->input();

    $email = $data['email'] ?? null;
    $phone = $data['phone'] ?? null;
    $password = $data['password'] ?? '';
    $confirm = $data['confirm'] ?? '';
    $errors = [];

    // Validation
    if (!$email && !$phone) {
        $errors[] = "Email or phone is required.";
    }
    if ($password !== $confirm) {
        $errors[] = "Passwords do not match.";
    }
    if (strlen($password) < 8 || !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors[] = "Password must be at least 8 characters with one special character.";
    }

    if (!empty($errors)) {
        return $this->error($errors, 422);
    }

    // Hash password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Save user
    $success = User::create($this->db, [
        'email' => $email,
        'phone' => $phone,
        'password' => $hashedPassword
    ]);

    if ($success) {
        $this->response(['success' => true]);
    } else {
        $this->error("Registration failed. Maybe email or phone already exists.", 500);
    }
}



}

?>