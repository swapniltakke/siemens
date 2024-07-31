<?php
include 'db.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute([':id' => $id]);
        echo json_encode(["message" => "User deleted successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error deleting user: " . $e->getMessage()]);
    }
}
?>