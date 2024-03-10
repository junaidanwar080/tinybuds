<?php
include('../connect.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['loggedin'] !== true) {
    header("Location: LogInPage.php");
    exit();
}

if (isset($_POST['delete-recipe'])) {
    $recipeId = $_POST['recipe-id'];

    
    echo "Are you sure you want to delete this recipe?";
    echo "<form method='post' action=''>
            <input type='hidden' name='recipe-id' value='$recipeId'>
            <input type='submit' name='confirm-delete' value='Yes'>
            <input type='submit' name='cancel-delete' value='No'>
          </form>";
} elseif (isset($_POST['confirm-delete'])) {
    $recipeId = $_POST['recipe-id'];

    $sqlDeleteIngredients = "DELETE FROM recipeingredients WHERE RecipeID = '$recipeId'";
if ($conn->query($sqlDeleteIngredients)) {
    $sqlDeleteRecipe = "DELETE FROM recipe WHERE ID = '$recipeId'";
    if ($conn->query($sqlDeleteRecipe)) {
       
        echo "Recipe deleted successfully.";
    } else {
        
        echo "Error deleting recipe: " . $conn->error;
    }
} 
    
} 
?>