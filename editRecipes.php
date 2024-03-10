<?php
include('connect.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['loggedin'] !== true) {
    header("Location: LogInPage.php");
    exit();
}

if (isset($_POST['edit-recipe'])) {
    $recipeId = $_POST['recipe-id'];

    // Fetch the existing recipe details from the database
    $selectQuery = "SELECT * FROM recipe WHERE ID = '$recipeId'";
    $result = $conn->query($selectQuery);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Display the form with existing recipe details
        echo "<form method='post' action='' style='max-width: 500px; margin: 0 auto;'>
        <input type='hidden' name='recipe-id' value='$recipeId'>
        <label for='recipe-name'>Recipe Name:</label>
        <input type='text' id='recipe-name' name='recipe-name' value='".$row['RecipeTitle']."' style='width: 100%; padding: 5px; margin-bottom: 10px;'><br>
        <label for='recipe-description'>Recipe Description:</label>
        <textarea id='recipe-description' name='recipe-description' style='width: 100%; height: 100px; padding: 5px; margin-bottom: 10px;'>".$row['Description']."</textarea><br>
        <label for='recipe-photo'>Recipe Photo:</label>
        <input type='file' id='recipe-photo' name='recipe-photo' style='margin-bottom: 10px;'><br>
        <input type='submit' name='save-changes' value='Save Changes' style='padding: 10px 20px; background-color: #4CAF50; color: white; border: none; cursor: pointer;'>
      </form>";
    } else {
        echo "Recipe not found.";
    }
} elseif (isset($_POST['save-changes'])) {
    $recipeId = $_POST['recipe-id'];
    $recipeName = $_POST['recipe-name'];
    $recipeDescription = $_POST['recipe-description'];
    $photo=$_POST['recipe-photo'];
    $base64Photo = base64_encode($photo);

    // Update the recipe details in the database
    $updateQuery = "UPDATE recipe SET RecipeTitle = '$recipeName', Description = '$recipeDescription' , photo='$base64Photo 'WHERE ID = '$recipeId'";
    if ($conn->query($updateQuery)) {
        echo "Recipe updated successfully.";
    } else {
        echo "Error updating recipe: " . $conn->error;
    }
} else {
    // Display your recipe listing or other content here
    // ...
}
?>