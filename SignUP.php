<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Sign Up</title>
  <link rel="stylesheet" href="SignUpStyle.CSS">
</head>

<body>
  <h1 id="SignUptitle">Sign Up</h1>
  <br />

  <form action="php\SignUpparent.php" method="Post" >
    <label for="username">Username:</label>
    <input type="text" id="username" name="Name" required/>
    <br />
    <br />
    <label for="email">Email:</label>
    <input type="email" id="email" name="Email" onblur="validateEmail(this.value) required/>
    <br /><br />

    </div>
    <label for="password">Password:</label>
    <input type="password" id="password" name="Password"  required/>
    <input type="checkbox" id="showPassword" onchange="PasswordVisibility()"> Show Password
    <br /><br />
    <!-- Checkboxes for selecting role -->
    <label>Select Role:</label><br>
    <input type="checkbox" id="roleParent" name="is_admin" value="1" checked>
    <label for="roleParent">Parent</label><br>
    <input type="checkbox" id="roleAdmin" name="is_parent" value="admin">
    <label for="roleAdmin">Admin</label><br>
    <input type="checkbox" id="roleDietitian" name="is_dietitian" value="dietitian">
    <label for="roleDietitian">Dietitian</label><br>
    <br />
    <button type="submit">Sign In</button> <br> <br>
    <label id="login">Already have an account?</label>
    <a href="LogInPage.php">login</a>
    <label id="DietitianSU">Do you want to Sign Up as a Dietitian?</label>
    <a href="DietitianSU.php">Dietitian Sign Up</a>
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