<?php
include 'db.php';

header('Content-Type: application/json');

try {
    $stmt = $pdo->query('SELECT id, email, fullname, country FROM users');
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($users);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to retrieve users']);
}
?>