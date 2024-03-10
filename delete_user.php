<?php
// Include the database connection file
require_once "connect.php";

// Check if the ID parameter is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to User page if ID is not provided
    header('location: User.php');
    exit;
}

// Get the ID from the URL query parameter
$user_id = $_GET['id'];

// Prepare an update statement to set deleted_at to 1
$sql = "UPDATE parent SET deleted_at = 1 WHERE ID = ?";

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);

    // Set parameters
    $param_id = $user_id;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
        // After successfully soft deleting the record
        header('location: User.php?success=delete');
        exit;
    } else {
        // Redirect to User page with error message
        header('location: User.php?error=delete');
        exit;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
