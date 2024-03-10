<?php
// Include the database connection file
require_once "connect.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $certificate = $_POST['certificate'];

    // Update dietitian information in the database
    $sql = "UPDATE dietitian SET Name='$name', Email='$email', Certificate='$certificate' WHERE ID=$id";

    if ($conn->query($sql) === TRUE) {
        // Redirect to Dietitian page with success message
        header('location: Dietitian.php?success=update');
        exit;
    } else {
        // Redirect to Dietitian page with error message
        header('location: Dietitian.php?error=update');
        exit;
    }
} else {
    // If form is not submitted, redirect to Dietitian page
    header('location: Dietitian.php');
    exit;
}
?>
