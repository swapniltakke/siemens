<?php
include 'db.php';

header("Content-Type: application/json");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $email = $_POST['email'];
    $fullname = $_POST['fullname'];
    $country = $_POST['country'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["error" => "Invalid email format"]);
        exit();
    }

    try {
        $stmt = $pdo->prepare("UPDATE users SET email = :email, fullname = :fullname, country = :country WHERE id = :id");
        $stmt->execute([
            ':email' => $email,
            ':fullname' => $fullname,
            ':country' => $country,
            ':id' => $id
        ]);
        echo json_encode(["message" => "User updated successfully"]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error updating user: " . $e->getMessage()]);
    }
}
?>