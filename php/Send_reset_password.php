<?php
include('../connect.php');
require_once('../mail.php');

$Email = $_POST["Email"];
$escapedEmail = $conn->real_escape_string($Email);
$token = bin2hex(random_bytes(32));
$tokenHash = hash("sha256", $token);
$ET= date("Y-m-d H:i:s", strtotime('+30 minutes'));

$resetLink = "https://localhost/persnol-work/project/ResetPW.php?token=" . $tokenHash;
$emailContent = "Click the following link to reset your password: " . $resetLink;

$sql = "SELECT * FROM Parent WHERE Email='$escapedEmail'";
$result = $conn->query($sql);


if ($result->num_rows>0) {

    
    $updateToken = "UPDATE Parent SET reset_token_hash='$tokenHash', reset_token_expires_at='$ET' WHERE Email='$escapedEmail'";
    $conn->query($updateToken);

    $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
    $mail->addAddress($Email);
    $mail->Subject='subject ';
    $mail->Body= $emailContent;
    $mail->send();
    exit;
} else{
    $sql ="SELECT * FROM Dietitian WHERE Email='$escapedEmail'";
    $result = $conn->query($sql);
    
  
  
    if ($result->num_rows>0) {

        
        $updateToken = "UPDATE Dietitian SET reset_token_hash='$tokenHash', reset_token_expires_at='$ET' WHERE Email='$escapedEmail'";
        $conn->query($updateToken);

        $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
        $mail->addAddress($Email);
        $mail->Subject='subject ';
        $mail->Body= $emailContent;
        $mail->send();
        exit;
    }else{
    $sql ="SELECT Email FROM Admin WHERE Email='$escapedEmail'";
    $result = $conn->query($sql);
    
    
    
    if ($result->num_rows>0) {

        $updateToken = "UPDATE Admin SET reset_token_hash='$tokenHash', reset_token_expires_at='$ET' WHERE Email='$escapedEmail'";
        $conn->query($updateToken);

        $mail->setFrom('tinytastebudswebsite@gmail.com','tinytastebuds');
        $mail->addAddress($Email);
        $mail->Subject='subject ';
        $mail->Body= $emailContent;
        $mail->send();
        exit;
    }else{

         echo("Email is not signup on our website");
         exit;
    }
     


    }
}






?>