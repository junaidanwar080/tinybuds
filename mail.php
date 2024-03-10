<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


require 'mailer/autoload.php';


$mail = new PHPMailer();

    
   // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                                
    $mail->SMTPAuth   = true;                                  
    $mail->Username   = 'tinytastebudswebsite@gmail.com';                          
    $mail->Password   = 'vmve xwwj iaeo wfih';                       
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                   
    
    
    $mail->isHTML(true);       
    $mail->CharSet = "UTF-8"; 

?>

