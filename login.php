<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/style1.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container">
    <div class="form-box box">

      <?php
      include "connection.php";

      if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $pass = $_POST['password'];

        // Use prepared statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $password = $row['password'];

          if (password_verify($pass, $password)) {
            $_SESSION['user_id'] = $row['id']; // Store user_id in session
            $_SESSION['username'] = $row['username'];
            header("location: home.php");
            exit();
          } else {
            echo "<div class='message'>
                    <center><p>Wrong Password</p></center>
                    <center></div><br></center>";
            echo "<center><a href='login.php'><button class='btn'>Go Back</button></a></center>";
          }
        } else {
          echo "<div class='message'>
                  <center><p>Wrong Email or Password</p></center>
                  </div><br>";
          echo "<center><a href='login.php'><button class='btn'>Go Back</button></a></center>";
        }

        $stmt->close();
      } else {
      ?>

        <header>Login</header>
        <hr>
        <form action="#" method="POST">
          <div class="form-box">
            <div class="input-container">
              <i class="fa fa-envelope icon"></i>
              <input class="input-field" type="email" placeholder="Email Address" name="email" required>
            </div>
            <div class="input-container">
              <i class="fa fa-lock icon"></i>
              <input class="input-field password" type="password" placeholder="Password" name="password" required>
              <i class="fa fa-eye toggle icon"></i>
            </div>
          </div>
          <center><input type="submit" name="login" id="submit" value="Login" class="btn"></center>
          <div class="links">
            Return to Start Page? <a href="index.php">Click Here</a>
          </div>
          <div class="links">
            Don't have an account? <a href="signup.php">Signup Now</a>
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
