<!-- Dietitian.php -->
<?php
// Include the database connection file
require_once "connect.php";
// Check if success parameter is present in the URL
if (isset($_GET['success'])) {
    $success = $_GET['success'];
    if ($success == 'add') {
        echo '<div class="container mt-3 alert alert-success" role="alert">';
        echo 'Dietitian added successfully!';
        echo '</div>';
    } elseif ($success == 'update') {
        echo '<div class="container mt-3 alert alert-success" role="alert">';
        echo 'Dietitian updated successfully!';
        echo '</div>';
    } elseif ($success == 'delete') {
        echo '<div class="container mt-3 alert alert-success" role="alert">';
        echo 'Dietitian deleted successfully!';
        echo '</div>';
    }
}

// Fetch data from the dietitian table
$sql = "SELECT ID, Name, Email FROM dietitian WHERE deleted_at = 0";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dietitian Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Dietitian Page</h1>
        <div class="mb-3">
            <a href="create_dietitian.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Dietitian</a>
        </div>
        <div class="table-responsive">
            <table id="dietitianTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any rows returned
                    if ($result->num_rows > 0) {
                        // Output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["ID"] . "</td>";
                            echo "<td>" . $row["Name"] . "</td>";
                            echo "<td>" . $row["Email"] . "</td>";
                            echo "<td>";
                            echo '<a href="edit_dietitian.php?id=' . $row["ID"] . '" class="btn btn-primary btn-sm mr-2">Edit</a>';
                            echo '<a href="delete_dietitian.php?id=' . $row["ID"] . '" class="btn btn-danger btn-sm">Delete</a>';
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No dietitians found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#dietitianTable').DataTable();
        });
    </script>
</body>
</html>
