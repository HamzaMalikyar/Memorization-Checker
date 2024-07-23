<?php
session_start();
include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Info</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <div class="container">
        <div class="form-box box">

            <?php
            if (isset($_POST['update'])) {
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $security_question = $_POST['security_question'];
                $security_answer = $_POST['security_answer'];

                $id = $_SESSION['id'];
                $passwd = password_hash($password, PASSWORD_DEFAULT);

                $edit_query = "UPDATE users SET username=?, email=?, password=?, security_question=?, security_answer=? WHERE id=?";
                $stmt = mysqli_prepare($conn, $edit_query);
                mysqli_stmt_bind_param($stmt, 'sssssi', $username, $email, $passwd, $security_question, $security_answer, $id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<div class='message'>
                        <center><p>Profile Updated!</p></center>
                        </div><br>";
                    echo "<center><a href='login.php'><button class='btn'>Log in</button></a></center>";
                } else {
                    echo "<div class='message'>
                        <center><p>Update Failed. Please try again.</p></center>
                        </div><br>";
                }
            } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id") or die("error occurs");

                while ($result = mysqli_fetch_assoc($query)) {
                    $res_username = $result['username'];
                    $res_email = $result['email'];
                    $res_password = $result['password'];
                    $res_security_question = $result['security_question'];
                    $res_security_answer = $result['security_answer'];
                }
                ?>

                <header>Change Profile</header>
                <form action="#" method="POST" enctype="multipart/form-data">

                    <div class="form-box">

                        <div class="input-container">
                            <i class="fa fa-user icon"></i>
                            <input class="input-field" type="text" placeholder="Username" name="username" value="" required>
                        </div>

                        <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" placeholder="Email Address" name="email" value="" required>
                        </div>

                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input class="input-field password" type="password" placeholder="New Password" name="password" value="" required>
                            <i class="fa fa-eye toggle icon"></i>
                        </div>

                        <!-- Security Question Section -->
                        <div class="input-container">
                            <i class="fa fa-question icon"></i>
                            <select class="input-field" name="security_question" required>
                                <option value="" disabled>Select Security Question</option>
                                <option value="What is your mother's maiden name?" <?php echo $res_security_question == "What is your mother's maiden name?" ? "selected" : ""; ?>>What is your mother's maiden name?</option>
                                <option value="What was the name of your first pet?" <?php echo $res_security_question == "What was the name of your first pet?" ? "selected" : ""; ?>>What was the name of your first pet?</option>
                                <option value="What was the name of your elementary school?" <?php echo $res_security_question == "What was the name of your elementary school?" ? "selected" : ""; ?>>What was the name of your elementary school?</option>
                            </select>
                        </div>
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input class="input-field" type="text" placeholder="Security Answer" name="security_answer" value="" required>
                        </div>

                    </div>

                    <div class="field">
                        <center><input type="submit" name="update" id="submit" value="Update" class="btn"></center>
                    </div>

                </form>
            </div>
        <?php } ?>
    </div>

    <script>
        const toggle = document.querySelector(".toggle"),
            input = document.querySelector(".password");
        toggle.addEventListener("click", () => {
            if (input.type === "password") {
                input.type = "text";
                toggle.classList.replace("fa-eye-slash", "fa-eye");
            } else {
                input.type = "password";
            }
        })
    </script>

</body>

</html>
