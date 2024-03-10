<?php
include('connect.php');


$selectedIngredients = isset($_GET['ingredients']) ? $_GET['ingredients'] : [];
$selectedAllergies = isset($_GET['allergies']) ? $_GET['allergies'] : [];


if (!empty($selectedIngredients)) {
  $ingredientIds = implode(',', $selectedIngredients);

  $sql = "SELECT DISTINCT r.ID, r.RecipeTitle, r.Photo, r.Description
          FROM Recipe r
          INNER JOIN RecipeIngredients ri ON r.ID = ri.RecipeID
          INNER JOIN Ingredients i ON ri.IngredientID = i.ID
          WHERE i.ID IN ($ingredientIds)";

  if (!empty($selectedAllergies)) {
    $allergyIds = implode(',', $selectedAllergies);

    $sql .= " AND r.ID NOT IN (
                SELECT ra.id
                FROM Allergies ra
                WHERE ra.id IN ($allergyIds)
              )";
  }

 
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      $recipeID = $row["ID"];
      $recipeTitle = $row["RecipeTitle"];
      $photo = $row["Photo"];
      $description = $row["Description"];
      $photoSrc = 'data:image/jpeg;base64,' . base64_encode($photo);
      echo '<div class="ttb-card">
        <img src="' . $photoSrc . '" alt="Photo" style="width: 100%; height: auto;">
        <div style="padding: 10px;">
          <h4 style="font-weight: bold;">'.$recipeTitle.'</h4>
          <p>'.$description.'</p>
          <a href="view_recipe.php?recipeID='.$recipeID.'" style="text-decoration: none; color: #000; background-color: #ebebeb; padding: 5px 10px; border-radius: 4px;">View Recipe...</a>
        </div>
      </div>';
    }
  } else {
    echo "No recipes found.";
  }
} else {
  echo "Please select at least one ingredient.";
}

$conn->close();
?>