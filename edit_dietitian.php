<?php
// Include the database connection file
require_once "connect.php";
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // Redirect to Dietitian page if ID is not provided
    header('location: Dietitian.php');
    exit;
}
$dietitian_id = $_GET['id'];
$sql = "SELECT * FROM dietitian WHERE ID = $dietitian_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $dietitian = $result->fetch_assoc();
} else {
  // After successfully updating the dietitian's information
header('location: Dietitian.php?success=update');
exit;

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dietitian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Dietitian</h1>
        <form action="update_dietitian.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $dietitian['ID']; ?>">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $dietitian['Name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $dietitian['Email']; ?>" required>
            </div>
            <div class="form-group">
                <label for="certificate">Certificate</label>
                <input type="text" class="form-control" id="certificate" name="certificate" value="<?php echo $dietitian['Certificate']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
