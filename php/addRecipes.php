<?php
include('../connect.php');
session_start();
if (!isset($_SESSION['username']) || $_SESSION['loggedin'] !== true) {
    header("Location: LogInPage.php");
    exit();
}

$recipeTitle = $_POST['recipe-title'];
$recipePhoto = $_POST['recipe-photo'];
$base64Photo = base64_encode($recipePhoto );
$ingredients = $_POST['ingredients'];
$allergies = implode(",", $_POST['allergies']); // Convert array to comma-separated string
$description = $_POST['recipe-Desc'];
$username = $_SESSION['username'];

$sql = "SELECT ID, 'Parent' AS role FROM parent WHERE Name = '$username'
        UNION ALL
        SELECT ID, 'Dietitian' AS role FROM dietitian WHERE Name = '$username';";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $userId = $row["ID"];
    $role = $row["role"];
    if ($role == "Parent") {
        $parentId = $userId;
        $dietitianId = null;
    } elseif ($role == "Dietitian") {
        $parentId = null;
        $dietitianId = $userId;
    } else {
        echo "Invalid user type.";
        exit();
    }
} 

if ($dietitianId === null) {
    $sql = "INSERT INTO recipe (ParentID, DietitianID, RecipeTitle, Photo, Description, allergiesID) 
    VALUES ('$parentId', null, '$recipeTitle', '$$base64Photo', '$description', '$allergies')";
} else {
    $sql = "INSERT INTO recipe (ParentID, DietitianID, RecipeTitle, Photo, Description, allergiesID) 
    VALUES (null, '$dietitianId', '$recipeTitle', '$$base64Photo', '$description', '$allergies')";
}

if (!$conn->query($sql)) {
    echo "Error: " . $conn->error;
    exit();
}

$recipeId = $conn->insert_id;

if (!empty($ingredients)) {
    foreach ($ingredients as $ingredientId) {
        $sql = "INSERT INTO recipeingredients (IngredientID, allergiesID, RecipeID) 
                VALUES ('$ingredientId', '$allergies', '$recipeId')";
        $conn->query($sql);
    }
}

echo "Recipe added successfully.";

?>