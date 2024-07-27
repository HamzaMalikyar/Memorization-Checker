<?php
session_start();
require 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch the progress data for the user
$sql = "SELECT input_text, missed_percentage, created_at FROM results WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$progress_data = [];
while ($row = $result->fetch_assoc()) {
    $input_text = $row['input_text'];
    $missed_percentage = $row['missed_percentage'];
    $created_at = $row['created_at'];

    if (!isset($progress_data[$input_text])) {
        $progress_data[$input_text] = [];
    }

    $progress_data[$input_text][] = [
        'missed_percentage' => $missed_percentage,
        'created_at' => $created_at
    ];
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Progress - Memorization Checker</title>
    <link rel="stylesheet" href="css/style5.css">
    <style>
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h1 {
            margin: 0;
        }
        .progress-summary {
            margin-bottom: 30px;
        }
        .progress-summary h2 {
            margin-top: 0;
        }
        .stats-list {
            list-style: none;
            padding: 0;
        }
        .stats-list li {
            margin-bottom: 10px;
        }
        .text-progress {
            margin-bottom: 20px;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
        }
    </style>
</head>

<body>
<div class="container">
    <header>
        <h1>Track Your Progress</h1>
    </header>

    <section class="detailed-statistics">
        <h2>Detailed Statistics</h2>
        <?php foreach ($progress_data as $text => $records): ?>
            <div class="text-progress">
                <h3><?php echo htmlspecialchars($text); ?></h3>
                <ul class="stats-list">
                    <?php foreach ($records as $record): ?>
                        <li>
                            <strong>Date:</strong> <?php echo $record['created_at']; ?>,
                            <strong>Missed Percentage:</strong> <?php echo $record['missed_percentage']; ?>%
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; ?>
    </section>
    <a href="home.php" class="back-btn">Back to Home</a>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Memorization Checker. All rights reserved.</p>
        <p>Contact: <a href="mailto:contact@memorizationchecker.com" style="color: #fff;">contact@memorizationchecker.com</a></p>
    </div>
</footer>
</body>

</html>
