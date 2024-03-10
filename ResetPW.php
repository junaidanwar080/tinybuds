<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Reset Password</title>
  <link rel="stylesheet" href="LoginPagesStyle.css">
</head>

<body>
  <h1>Reset Password</h1>
  <br>
<div id="resetPasswordForm" style="display: block;">
    <p style="text-align: center;">Please enter your new password.</p>
     
     
    <form id="newPasswordForm" action="php\updatepassword copy.php" method="POST">
      <label for="newPassword">New Password:</label>
      <input type="password" id="newPassword" name="newPassword" required><br><br>
      <label for="confirmPassword">Confirm Password:</label>
      <input type="password" id="confirmPassword" name="confirmPassword" required><br><br>

      <button type="submit">Reset Password</button>
      
    </form>
  </div>
  </body>
  </html>