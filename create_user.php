<?php
include 'db.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email format']);
    exit();
}

$email = $data['email'];
$fullname = $data['fullname'];
$password = password_hash($data['password'], PASSWORD_DEFAULT);
$country = $data['country'];

try {
    $stmt = $pdo->prepare('INSERT INTO users (email, fullname, password, country) VALUES (?, ?, ?, ?)');
    $stmt->execute([$email, $fullname, $password, $country]);
    echo json_encode(['success' => true]);
} catch (PDOException $e) {
    http_response_code(400);
    echo json_encode(['error' => 'User creation failed']);
}
?>