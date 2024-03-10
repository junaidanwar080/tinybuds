<?php
session_start();


$storedVerificationCode = $_SESSION['verification_code'];
$storedEmail = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $enteredVerificationCode = $_POST['verification_code'];

    if ($storedVerificationCode === $enteredVerificationCode) {
       
        header("Location: ResetPW.php.?email=$storedEmail");
        exit;
    } else {
       
        $error = "Invalid verification code. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Verification</title>
    <link rel="stylesheet" href="LoginPagesStyle.css">
</head>
<body>
    <h2>Enter Verification Code</h2>
    <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
    <?php } ?>
    <form method="POST" action="">
        <label for="verification_code">Verification Code:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <br>
        <button type="submit">Verify</button>
    </form>
</body>
</html>