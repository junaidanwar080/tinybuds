<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" type="text/css" href="RecipeForm.CSS">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add recipe</title>
  <meta charset="UTF-8">
</head>
<body>
  <div class="container">
    <form  action="php\addRecipes.php"method="post">
      <label for="recipe-title">Recipe Title:</label>
      <input type="text" id="recipe-title" name="recipe-title" required> <br><br>
      <input type="file" id="recipe-photo" name="recipe-photo" > <br><br>

      <label for="ingredients">Ingredients:</label>
      <ul id="ingredients">
       
          <?php
          session_start();
          if (!isset($_SESSION['username'])|| $_SESSION['loggedin'] !== true) {
             
              header("Location: LogInPage.php"); 
              exit(); 
          }
          include('connect.php');
          $sql = "SELECT ID, Name FROM Ingredients";
          $result = $conn->query($sql);
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id = $row["ID"];
              $name = $row["Name"];
              echo "<li><input type='checkbox' name='ingredients[]' value='$id'>$name</li>";
            }
          } else {
            echo "No items found in the database.";
          }
          ?>
        
      </ul> <br>

      <label for="allergies">Allergies:</label>
      <ul id="allergies">
      <?php
            include('connect.php');
            $sql = "SELECT ID, Name FROM allergies";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $id = $row["ID"];
                $name = $row["Name"];
                echo "<li><input type='checkbox' name='allergies[]' value='$id'>$name</li>";
              }
            } else {
              echo "No allergies found in the database.";
            }
            ?>
      </ul><br> <br>
      <label for="recipe-title">Recipe Description:</label> <br> <br>
      <input type="text" id="recipe-Desc" name="recipe-Desc" required class="big-input"> <br><br>
      
        <button type="submit">Submit</button>
    </form>
  </div>
</body>
</html>