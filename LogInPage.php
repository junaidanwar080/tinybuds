<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="LoginPagesStyle.css">
</head>

<body>
  <h1>Login</h1>
  <br>
  <br>

  <form id="loginForm" action="php\login.php" method="post">
   
    <label for="username">Username or Email:</label>
    <input type="text" id="username" name="n1" required>  <br>
    <br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="n2" required>
    <input type="checkbox" id="showPassword" onchange="PasswordVisibility()"> Show Password
    <br>
    <br>

    <button type="submit">Log In</button>
    <a href="ForgotPW.php" id="forgotPasswordLink">Forgot password?</a>
    <a href="SignUP.php" id="forgotPasswordLink">new account?</a>
  </form>
  </div>
  <script >
    var loginForm = document.getElementById('loginForm');
    var forgotPasswordLink = document.getElementById('forgotPasswordLink');
    var forgotPasswordForm = document.getElementById('forgotPasswordForm');
    var verificationForm = document.getElementById('verificationForm');
    var resetPasswordForm = document.getElementById('resetPasswordForm');

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