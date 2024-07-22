<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Center - Memorization Checker</title>
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
        .feedback-link,
        .tutorials-link {
            display: block;
            margin-bottom: 10px;
        }
        .privacy-info {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .privacy-info h2 {
            margin-top: 0;
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

    <section>
        <h2>Frequently Asked Questions (FAQs)</h2>
        <ul>
            <li>How do I use the memorization tools?</li>
            <li>How do I reset my password?</li>
            <li>What should I do if the app freezes?</li>
            <li>How do I track my progress?</li>
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
            <li><a href="tutorial1.php">How to Use the App</a></li>
            <li><a href="tutorial2.php">Setting Goals and Tracking Progress</a></li>
        </ul>
    </section>

    <section class="privacy-info">
        <h2>Privacy</h2>
        <p><strong>Your Privacy Matters:</strong> We are committed to protecting your data. For more information on how we handle your information, please refer to our Privacy Policy.</p>
    </section>

    <section class="contact-form">
        <h2>Have a Question?</h2>
        <form action="submit_question.php" method="post">
            <textarea name="question" placeholder="Type your question here..."></textarea>
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
