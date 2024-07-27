<?php
session_start();
require 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorials - Memorization Checker</title>
    <link rel="stylesheet" href="css/style.css">
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
        section {
            margin-bottom: 20px;
        }
        .tutorial-section {
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
        <h1>Tutorials</h1>
    </header>

    <section id="use-the-app" class="tutorial-section">
        <h2>How to Use the App</h2>
        <p>To start using the app, follow these steps:</p>
        <ol>
            <li>Log in to your account.</li>
            <li>Select or paste the text you want to memorize.</li>
            <li>Use the provided tools to practice and track your progress.</li>
        </ol>
    </section>

    <section id="setting-goals" class="tutorial-section">
        <h2>Setting Goals and Tracking Progress</h2>
        <p>To set goals and track your progress, follow these steps:</p>
        <ol>
            <li>Go to the 'Set Goals' page.</li>
            <li>Enter your memorization goals and save them.</li>
            <li>Track your progress on the 'Track Progress' page.</li>
        </ol>
    </section>
</div>

<footer>
    <div class="container">
        <p>&copy; 2024 Memorization Checker. All rights reserved.</p>
        <p>Contact: <a href="mailto:contact@memorizationchecker.com" style="color: #fff;">contact@memorizationchecker.com</a></p>
    </div>
</footer>
</body>

</html>
