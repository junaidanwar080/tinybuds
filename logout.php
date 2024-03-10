<?php
// Start the session
session_start();

// Destroy all session data
session_destroy();

// Redirect to the login page or any other page you prefer
header("Location: LogInPage.php");  // Replace "login.php" with the desired URL
exit();
?>