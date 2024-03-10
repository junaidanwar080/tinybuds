<?php
include('connect.php');


$recipeId = $_GET['recipe_id'];


$sql = "SELECT * FROM recipe WHERE ID = $recipeId";



$result = $conn->query($sql);



if ($result->num_rows > 0) {
  
  $row = $result->fetch_assoc();
  $recipeTitle = $row["RecipeTitle"];
  $description = $row["Description"];
  $recipePhoto = isset($row["photo"]) ? $row["photo"] : null;

  echo "<div align='center'>";
  echo "<h2>Recipe Details</h2>";
  echo "<h3>$recipeTitle</h3>";
  echo "<p>$description</p>";
  if (!empty($recipePhoto)) {
    $imageData = base64_encode($recipePhoto);
    echo "<img src='data:image/jpeg;base64,$imageData' alt='Recipe Photo'>";
  } else {
    echo "Image not found";
  }
  echo "<form method='post' action='editRecipes.php'> 
                <input type='hidden' name='recipe-id' value='$recipeId'>
                <input type='submit' name='edit-recipe' value='Edit'>
              </form>";
                            echo "<form method='post' action='php\deleteRecipe.php'>
                <input type='hidden' name='recipe-id' value='$recipeId'>
                <input type='submit' name='delete-recipe' value='Delete'>
              </form>";
  echo "</div>";
} 
?>