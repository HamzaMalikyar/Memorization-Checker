<?php
session_start();
require 'connection.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, goal, completed FROM goals WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$goals = [];
while ($row = $result->fetch_assoc()) {
    $goals[] = $row;
}
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Goals - Memorization Checker</title>
    <link rel="stylesheet" href="css/style5.css">
    <script>
        function toggleGoalCompletion(goalId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'toggle_goal.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById(`goal-${goalId}`).classList.toggle('completed');
                }
            };
            xhr.send(`id=${goalId}`);
        }

        function deleteGoal(goalId) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_goal.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById(`goal-${goalId}`).remove();
                }
            };
            xhr.send(`id=${goalId}`);
        }
    </script>
</head>

<body>
<div class="container">
    <header>
        <h1>Set Goals</h1>
    </header>

    <section>
        <h2>Create and Manage Goals</h2>
        <form action="save_goals.php" method="post">
            <label for="goal">Enter your memorization goal:</label>
            <input type="text" id="goal" name="goal" required>
            <button type="submit">Save Goal</button>
        </form>

        <h2>Your Goals</h2>
        <ul id="goalsList">
            <?php foreach ($goals as $goal): ?>
                <li id="goal-<?= $goal['id'] ?>" class="<?= $goal['completed'] ? 'completed' : '' ?>">
                    <input type="checkbox" onclick="toggleGoalCompletion(<?= $goal['id'] ?>)" <?= $goal['completed'] ? 'checked' : '' ?>>
                    <?= htmlspecialchars($goal['goal']) ?>
                    <button onclick="deleteGoal(<?= $goal['id'] ?>)">Delete</button>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Memorization Checker. All rights reserved.</p>
        <p>Contact: <a href="mailto:contact@memorizationchecker.com">contact@memorizationchecker.com</a></p>
    </div>
</footer>
</body>

</html>
