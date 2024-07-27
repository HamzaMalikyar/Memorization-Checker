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
    </style>
</head>

<body>
<div class="container">
    <header>
        <h1>Tutorials</h1>
    </header>

    <section class="video-container">
        <h2>Video Tutorial 1: How to Use the App</h2>
        <video controls width="100%">
            <source src="videos/tutorial1.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </section>

    <section class="video-container">
        <h2>Video Tutorial 2: Setting Goals and Tracking Progress</h2>
        <video controls width="100%">
            <source src="videos/tutorial2.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
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

