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
        .tutorial-section {
            margin-bottom: 20px;
        }
        .video-container {
            margin-bottom: 20px;
            text-align: center;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
        }
        .video-link {
            display: block;
            margin: 10px 0;
            color: #0066cc;
            text-decoration: none;
            font-size: 18px;
        }
        .video-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<div class="container">
    <header>
        <h1>Tutorials</h1>
    </header>

    <section class="video-container">
        <h2>Video Tutorial 1: How to Use the App</h2>
        <a href="https://youtu.be/r2zU1BgFZB4" class="video-link" target="_blank">Watch Tutorial 1 on YouTube</a>
    </section>

    <section class="video-container">
        <h2>Video Tutorial 2: Setting Goals and Tracking Progress</h2>
        <a href="https://youtu.be/IsrC1Agj6FI" class="video-link" target="_blank">Watch Tutorial 2 on YouTube</a>
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

