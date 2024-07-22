<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Memorization Checker</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #0066cc;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            height: 100px;
        }
        .form-group button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #005bb5;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <header>
        <h1>Feedback</h1>
    </header>

    <form action="submit_feedback.php" method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="feedback">Feedback</label>
            <textarea id="feedback" name="feedback" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">Submit</button>
        </div>
    </form>
</div>

<div class="footer">
    <p>&copy; 2024 Memorization Checker. All rights reserved.</p>
    <p>Contact: contact@memorizationchecker.com</p>
</div>

</body>
</html>

