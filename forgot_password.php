<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

<div class="container">
    <div class="form-box box">
        <?php
        if (isset($_POST['verify'])) { // Checks if the verify button was clicked
            $email = $_POST['email']; // Gets the email
            $query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die("Error occurs"); // Query the database for the email

            if (mysqli_num_rows($query) > 0) { // If the email is found
                $result = mysqli_fetch_assoc($query); // Fetches the result as an associative array
                $_SESSION['reset_email'] = $result['email']; // Stores email in session
                $_SESSION['reset_security_question'] = $result['security_question']; // Stores security question in session
                $_SESSION['reset_security_answer'] = $result['security_answer']; // Stores security answer in session
            } else { // If the email isnt found
                echo "<div class='message'>
                    <center><p>Email not found. Please try again.</p></center>
                    </div><br>";
                exit();
            }
        } elseif (isset($_POST['reset'])) { // Checks if the reset button was clicked
            $email = $_SESSION['reset_email']; // Gets the email from the session
            $security_answer = $_POST['security_answer']; // Gets the security answer
            $new_password = $_POST['new_password']; // Gets the new password
            $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT); // Hashes new password

            if ($security_answer === $_SESSION['reset_security_answer']) { // If the security answer is correct
                $update_query = "UPDATE users SET password=? WHERE email=?"; // Query to update password
                $stmt = mysqli_prepare($conn, $update_query); // Prepare SQL statement
                mysqli_stmt_bind_param($stmt, 'ss', $new_password_hashed, $email); // Bind parameters

                if (mysqli_stmt_execute($stmt)) { // Execute statement
                    echo "<div class='message'>
                        <center><p>Password Updated!</p></center>
                        </div><br>";
                    echo "<center><a href='login.php'><button class='btn'>Log in</button></a></center>";
                    session_unset(); // Unset all session variables
                    session_destroy(); // Destroy the session
                } else { // If update failed
                    echo "<div class='message'>
                        <center><p>Update Failed. Please try again.</p></center>
                        </div><br>";
                }
            } else { // If the security answer is wrong
                echo "<div class='message'>
                    <center><p>Incorrect security answer. Please try again.</p></center>
                    </div><br>";
            }
        }
        ?>

        <?php if (!isset($_POST['verify']) || (isset($_POST['verify']) && isset($result))) { ?>
            <header>Forgot Password</header>
            <form action="#" method="POST" enctype="multipart/form-data">

                <?php if (!isset($_SESSION['reset_email'])) { ?>
                    <div class="form-box">
                        <div class="input-container">
                            <i class="fa fa-envelope icon"></i>
                            <input class="input-field" type="email" placeholder="Email Address" name="email" required>
                        </div>
                        <div class="field">
                            <input type="submit" name="verify" value="Verify Email" class="btn">
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="form-box">
                        <div class="input-container">
                            <i class="fa fa-question icon"></i>
                            <p><?php echo $_SESSION['reset_security_question']; ?></p>
                        </div>
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input class="input-field" type="text" placeholder="Security Answer" name="security_answer" required>
                        </div>
                        <div class="input-container">
                            <i class="fa fa-lock icon"></i>
                            <input class="input-field password" type="password" placeholder="New Password" name="new_password" required>
                            <i class="fa fa-eye toggle icon"></i>
                        </div>
                    </div>

                    <div class="field">
                        <center><input type="submit" name="reset" value="Reset Password" class="btn"></center>
                    </div>
                <?php } ?>
            </form>
        <?php } ?>
    </div>
</div>

<script>
    const toggle = document.querySelector(".toggle"),
        input = document.querySelector(".password");
    toggle.addEventListener("click", () => { // Adds click event listener to toggle element
        if (input.type === "password") { // If input type is password
            input.type = "text"; // Change input type to text
            toggle.classList.replace("fa-eye-slash", "fa-eye"); // Replace class for toggle icon to show an eye
        } else {
            input.type = "password"; // If input type is text, change it back to password
        }
    })
</script>

</body>

</html>
