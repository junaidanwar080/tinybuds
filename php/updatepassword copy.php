<?php
include('../connect.php');
$newPassword = $_POST['newPassword'];
$confirmPassword = $_POST['confirmPassword'];

if ($newPassword !== $confirmPassword) {
    echo "New password and confirm password do not match.";
    exit;
}

$hPassword = password_hash($newPassword, PASSWORD_DEFAULT);

function check_email_exists($email, $tableName, $conn) {
    $escapedEmail = $conn->real_escape_string($email);

    $tables = array('parent', 'dietitian', 'admin');

    foreach ($tables as $tableName) {
        $sql = "SELECT COUNT(*) FROM $tableName WHERE Email = '$escapedEmail'";
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
session_start();
$email = $_SESSION['email'];
if (empty($email)) {
    echo "Invalid email.";
    exit;
}

$tableName = null;
if (check_email_exists($email, 'parent', $conn)) {
    $tableName = 'parent';
} elseif (check_email_exists($email, 'dietitian', $conn)) {
    $tableName = 'dietitian';
} elseif (check_email_exists($email, 'admin', $conn)) {
    $tableName = 'admin';
} else {
    echo "Email does not exist.";
    exit;
}

$sql = "SELECT * FROM $tableName WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $UpdatePassword = "UPDATE $tableName SET Password = '$hPassword' WHERE Email = '$email'";

    if ($conn->query($UpdatePassword)) {
        echo "Password reset successfully.";
    } else {
        echo "Error updating password: " . $conn->error;
        exit;
    }
} else {
    echo "Invalid email.";
    exit;
}
?>