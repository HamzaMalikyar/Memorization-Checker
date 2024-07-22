<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Goals - Memorization Checker</title>
    <link rel="stylesheet" href="css/style.css">
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
            <li>Memorize 50 new words</li>
            <li>Master pronunciation of 30 sentences</li>
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

