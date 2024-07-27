<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Memorization Checker</title>
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
        section {
            margin-bottom: 20px;
        }
        .feedback-link,
        .tutorials-link {
            display: block;
            margin-bottom: 10px;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #0066cc;
            color: #fff;
        }
        .contact-form textarea {
            width: 100%;
            height: 100px;
            margin-top: 10px;
        }
        .contact-form button {
            margin-top: 10px;
        }
    </style>
</head>

<body>
<div class="container">
    <header>
        <h1>Help Center</h1>
    </header>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['question'])) {
        $question = htmlspecialchars($_POST['question']);
        // Here you would typically save the question to a database or send it via email
        echo '<div class="confirmation">Thank you for your question. We will get back to you soon!</div>';
    }
    ?>
    <section>
        <h2>Frequently Asked Questions (FAQs)</h2>
        <ul>
            <li><strong>How do I use the memorization tools?</strong><br>
                You can start using the memorization tools by logging in and pressing the record button to memorize your selected text.
            <li><strong>How do I reset my password?</strong><br>
                To reset your password, click on the 'Forgot Password' link on the login page and follow the instructions to reset your password.
            </li>
            <li><strong>What should I do if the app freezes?</strong><br>
                If the app freezes, try refreshing the page or clearing your browser's cache. If the problem persists, contact support at contact@memorizationchecker.com.
            </li>
            <li><strong>How do I track my progress?</strong><br>
                You can track your progress by going to the 'Track Progress' page, where you'll see detailed statistics on your performance and progress.
            </li>
        </ul>
    </section>

    <section>
        <h2>Feedback</h2>
        <ul>
            <li><a href="feedback.php">Submit Feedback</a></li>
        </ul>
    </section>

    <section>
        <h2>Tutorials</h2>
        <ul>
            <li><a href="tutorials.php#use-the-app">How to Use the App</a></li>
            <li><a href="tutorials.php#setting-goals">Setting Goals and Tracking Progress</a></li>
        </ul>
    </section>

    <section class="contact-form">
        <h2>Have a Question?</h2>
        <form action="helpcenter.php" method="post">
            <textarea name="question" placeholder="Type your question here..." required></textarea>
            <button type="submit">Submit</button>
        </form>
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
