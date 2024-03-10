<?php
include('../connect.php');
require_once('../mail.php');

$Email = $_POST["Email"];
$escapedEmail = $conn->real_escape_string($Email);

    $characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
    $code = '';
    $max = strlen($characters) - 1;
    for ($i = 0; $i < 7; $i++) {
        $code .= $characters[random_int(0, $max)];
    }
  




$sql = "SELECT * FROM Parent WHERE Email='$escapedEmail'";
$result = $conn->query($sql);


if ($result->num_rows>0) {

    
    

    $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
    $mail->addAddress($escapedEmail);
    $mail->Subject='Password Reset Verification Code ';
    $mail->Body= "Your verification code is: " . $code;;
    $mail->send();
    session_start();
        $_SESSION['verification_code'] = $code;
        $_SESSION['email'] = $escapedEmail;
         header("Location: ../verification_page.php");
    exit;
} else{
    $sql ="SELECT * FROM Dietitian WHERE Email='$escapedEmail'";
    $result = $conn->query($sql);
    
  
  
    if ($result->num_rows>0) {

        
        

        $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
        $mail->addAddress($escapedEmail);
        $mail->Subject='Password Reset Verification Code ';
        $mail->Body= "Your verification code is: " . $code;;
        $mail->send();
        session_start();
        $_SESSION['verification_code'] = $code;
        $_SESSION['email'] = $escapedEmail;
         header("Location: ../verification_page.php");
        exit;
    }else{
    $sql ="SELECT Email FROM Admin WHERE Email='$escapedEmail'";
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows>0) {


        $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
        $mail->addAddress($escapedEmail);
        $mail->Subject='Password Reset Verification Code ';
        $mail->Body= "Your verification code is: " . $code;;
        $mail->send();
        session_start();
        $_SESSION['verification_code'] = $code;
        $_SESSION['email'] = $escapedEmail;
         header("Location: ../verification_page.php");

        exit;
    }else{

         echo("Email is not signup on our website");
         exit;
    }
     


    }
}






?>

