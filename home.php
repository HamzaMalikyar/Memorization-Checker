<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memorization Checker</title>
    <link rel="stylesheet" href="css/style5.css">
    <style>
        nav ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        nav ul li {
            display: inline-block;
            margin-right: 20px;
            position: relative;
        }
        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
        }
        nav ul li a:hover {
            text-decoration: underline;
        }
        nav ul li:hover .dropdown {
            display: block;
        }
        .dropdown {
            display: none;
            position: absolute;
            background-color: #0066cc;
            list-style-type: none;
            padding: 10px;
            top: 30px;
            left: 0;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .dropdown li {
            display: block;
            margin: 0;
        }
        .dropdown li a {
            color: #fff;
            padding: 8px 16px;
            display: block;
        }
        .dropdown li a:hover {
            background-color: #005bb5;
        }
    </style>
</head>

<body>
<header>
    <div class="container">
        <h1 class="site-title">Memorization Checker</h1>
        <nav>
            <ul>
                <li><a href="about.php">About Info</a></li>
                <li>
                    <a href="#">Features</a>
                    <ul class="dropdown">
                        <li><a href="set_goals.php">Set Goals</a></li>
                        <li><a href="track_progress.php">Track Progress</a></li>
                        <li><a href="help_center.php">Help Center</a></li>
                    </ul>
                </li>
                <li><a href="memorization_checker.php">Memorization Checker</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <section class="hero">
        <div class="container">
            <h2>Master Your Memory</h2>
            <p>Unlock your full potential with our innovative memorization tools.</p>
        </div>
    </section>
</main>

<footer>
    <div class="container">
        <p>&copy; 2024 Memorization Checker. All rights reserved.</p>
        <p>Contact: contact@memorizationchecker.com</p>
    </div>
</footer>
</body>

</html>
