<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Forget Password</title>
  <link rel="stylesheet" href="LoginPagesStyle.css">
</head>
<body>
  <h1>Forgot Password</h1>
  <br>
  <br>
  
<div id="forgotPasswordForm" style="display: block;">
    <p class="FPmessage">Please enter your email address</p>
    <form id="verificationForm" action="php/Send_reset_passwordbycode.php" method="post">
      <label for="email">Email:</label>
      <input type="email" id="email" name="Email" required>
      <br>
      <br>
      <button type="submit">Reset Password</button>

    </form>
</div>
<script>    var loginForm = document.getElementById('loginForm');
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
  }</script>
      

  
</body>
    </html>