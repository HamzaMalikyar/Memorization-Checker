<?php
session_start();
require 'connection.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $goal = $_POST['goal'];
    $user_id = $_SESSION['user_id']; // Assuming user_id is stored in session after login

    $stmt = $conn->prepare("INSERT INTO goals (user_id, goal) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $goal);
    $stmt->execute();
    $stmt->close();

    header("Location: set_goals.php"); // Redirect back to the goals page
    exit();
}
?>
