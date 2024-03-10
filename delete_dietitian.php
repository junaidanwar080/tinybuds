<?php
// Include the database connection file
require_once "connect.php";

// Check if the ID parameter is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to Dietitian page if ID is not provided
    header('location: Dietitian.php');
    exit;
}

// Get the ID from the URL query parameter
$dietitian_id = $_GET['id'];


// Prepare an update statement to set deleted_at to 1
$sql = "UPDATE dietitian SET deleted_at = 1 WHERE ID = ?";
// Prepare a delete statement

if ($stmt = $conn->prepare($sql)) {
    // Bind variables to the prepared statement as parameters
    $stmt->bind_param("i", $param_id);

    // Set parameters
    $param_id = $dietitian_id;

    // Attempt to execute the prepared statement
    if ($stmt->execute()) {
       // After successfully deleting the dietitian
        header('location: Dietitian.php?success=delete');
        exit;

    } else {
        // Redirect to Dietitian page with error message
        header('location: Dietitian.php?error=delete');
        exit;
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>
