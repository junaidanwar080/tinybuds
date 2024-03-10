<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dietitian Sign Up</title>
  <link rel="stylesheet" href="SignUpStyle.CSS">
</head>

<body>
  <h1 id="SignUptitle">Sign Up</h1>
  <br />

  <form action="php\SignUpDietitian.php" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="Name" required/>
    <br />
    <br />
    <label for="email">Email:</label>
    <input type="email" id="email" name="Email" required/>
    <br /><br />
    <div id="certificate" style="display: block">
      <label for="certificate">Certificate:</label>
    <input id="btn" type="file" name="Certificate" required>
      <br /><br />
    </div>
    </div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="Password" required/>
    
    <input type="checkbox" id="showPassword" onchange="PasswordVisibility()"> Show Password
    <br /><br />
    <button type="submit">Sign In</button> <br> <br>
    <label id="login">Already have an account?</label>
    <a href="LogInPage.php">login</a>
  </form>
  <script>
    var usernameField = document.getElementById("username");
    var emailField = document.getElementById("email");
    var certificateField = document.getElementById("certificate");
    var passwordField = document.getElementById("password");
    function PasswordVisibility() {
      var passwordInput = document.getElementById("password");
      var showPasswordCheckbox = document.getElementById("showPassword");

      if (showPasswordCheckbox.checked) {
        passwordInput.type = "text";
      } else {
        passwordInput.type = "password";
      }
    }

  </script>
</body>

</html>