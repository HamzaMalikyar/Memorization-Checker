<?php
session_start();
require 'connection.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'User not logged in']);
    exit();
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['inputText']) && isset($data['missedPercentage'])) {
    $user_id = $_SESSION['user_id'];
    $inputText = $data['inputText'];
    $missedPercentage = $data['missedPercentage'];

    $stmt = $conn->prepare("INSERT INTO results (user_id, input_text, missed_percentage) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $user_id, $inputText, $missedPercentage);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Database error']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid data']);
}

$conn->close();
?>
