<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">
      <header>Sign Up</header>
      <hr>
      <form action="#" method="POST">
        <div class="form-box">
          <?php
          session_start();
          include "connection.php";

          if (isset($_POST['register'])) {
            $name = $_POST['username'];
            $email = $_POST['email'];
            $pass = $_POST['password'];
            $cpass = $_POST['cpass'];
            $security_question = $_POST['security_question'];
            $security_answer = $_POST['security_answer'];

            $check = "SELECT * FROM users WHERE email=?";
            $stmt = mysqli_prepare($conn, $check);
            mysqli_stmt_bind_param($stmt, 's', $email);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);

            $passwd = password_hash($pass, PASSWORD_DEFAULT);

            if (mysqli_num_rows($res) > 0) {
              echo "<div class='message'><p>This email is used, Try another One Please!</p></div><br>";
              echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
            } else {
              if ($pass === $cpass) {
                $sql = "INSERT INTO users (username, email, password, security_question, security_answer) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, 'sssss', $name, $email, $passwd, $security_question, $security_answer);
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                  echo "<div class='message'><p>You are registered successfully!</p></div><br>";
                  echo "<a href='login.php'><button class='btn'>Login Now</button></a>";
                } else {
                  echo "<div class='message'><p>Registration failed, please try again.</p></div><br>";
                  echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button></a>";
                }
              } else {
                echo "<div class='message'><p>Password does not match.</p></div><br>";
                echo "<a href='signup.php'><button class='btn'>Go Back</button></a>";
              }
            }
          } else {
          ?>
            <div class="input-container">
              <i class="fa fa-user icon"></i>
              <input class="input-field" type="text" placeholder="Username" name="username" required>
            </div>
            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>
            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required>
              <i class="fa fa-eye icon toggle"></i>
            </div>
            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="password" placeholder="Confirm Password" name="cpass" required>
              <i class="fa fa-eye icon"></i>
            </div>
            <!-- Security Question Section -->
            <div class="input-container">
              <i class="fa fa-question icon"></i>
              <select class="input-field" name="security_question" required>
                <option value="" disabled selected>Select Security Question</option>
                <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
                <option value="What was the name of your first pet?">What was the name of your first pet?</option>
                <option value="What was the name of your elementary school?">What was the name of your elementary school?</option>
              </select>
            </div>
            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field" type="text" placeholder="Security Answer" name="security_answer" required>
            </div>
          </div>
          <center><input type="submit" name="register" id="submit" value="Signup" class="btn"></center>
          <div class="links">
            Return to Start Page? <a href="index.php">Click Here</a>
          </div>
          <div class="links">
            Already have an account? <a href="login.php">Sign in Now</a>
          </div>
        </form>
      </div>
      <?php
          }
      ?>
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
