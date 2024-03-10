<?php
    include('../connect.php');
    $newPassword=$_POST['newPassword'];
    $confirmPassword=$_POST['confirmPassword'];
    
   

    $token = $_GET['token'];
    if (empty($token)) {
        echo "Invalid token.";
        exit;
    }
    
    

    if ($newPassword !== $confirmPassword) {
      echo "New password and confirm password do not match.";
      exit;
  }
  $hPassword = password_hash($newPassword, PASSWORD_DEFAULT);
  
  function check_token_exists($token, $tableName, $conn) {
   $escapedToken = $conn->real_escape_string($token);

   $tables = array('parent', 'dietitian', 'admin');

   foreach ($tables as $tableName) {
       $sql = "SELECT COUNT(*) FROM $tableName WHERE reset_token_hash   = '$escapedToken'";
       $result = $conn->query($sql);

       if ($result) {
           $row = $result->fetch_row();
           if ($row[0] > 0) {
               return $tableName;
           }
       }
   }

   return false;
}
  
  $tableName = null;
  if (check_token_exists($token, 'parent', $conn)) {
      $tableName = 'parent';
  } elseif (check_token_exists($token, 'dietitian', $conn)) {
      $tableName = 'dietitian';
  } elseif (check_token_exists($token, 'admin', $conn)) {
      $tableName = 'admin';
  } else {
      echo "Invalid table name.";
      exit;
  }





  $escapedToken = $conn->real_escape_string($token);
    $cTime = date("Y-m-d H:i:s");
    $sql = "";
    if ($tableName === 'parent') {
        $sql = "SELECT * FROM parent WHERE reset_token_hash = '$token' AND reset_token_expires_at > '$cTime' ";
    } elseif ($tableName === 'dietitian') {
        $sql = "SELECT * FROM dietitian WHERE reset_token_hash = '$token' AND reset_token_expires_at > '$cTime' ";
    } elseif ($tableName === 'admin') {
        $sql = "SELECT * FROM admin WHERE reset_token_hash = '$token' AND reset_token_expires_at > '$cTime' ";
    }
    
    if ($sql !== "") {
        $stmt = $conn->prepare($sql);
        
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        echo "Invalid table name.";
        exit;
    }


    if ($result->num_rows > 0) {
       
        $UpdatePassword = "UPDATE $tableName SET Password='$hPassword', reset_token_hash=NULL, reset_token_expires_at=NULL WHERE reset_token_hash='$escapedToken'";
        if ($conn->query($UpdatePassword)) {
            echo "Password reset successfully.";
        } else {
            echo "Error updating password: " . $conn->error;
            exit;
        }
    } else {
        echo "Invalid or expired token.";
        exit;
    }

    

    ?>