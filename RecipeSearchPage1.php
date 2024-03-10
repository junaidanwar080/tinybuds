<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>Recipe Search Page</title>
    <link rel="stylesheet" href="RecipeSearchStyle1.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://unicons.iconscout.com/release/v4.0.0/css/line.css"
    />
  
  </head>
  <body>
    <form onsubmit="event.preventDefault(); action="RecipesSearch.php" method="GET" id="search">
      <!-- Should be connected with the Ingredients table by php -->
      <div class="ttb-column">
        <h4 for="Ingredients">Choose your favorite Ingredients:</h4>
        <div class="ttb-options">
          <ul>
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
          </ul>
        </div>
      </div>

    <div class="ttb-column">
    <h4 for="allergies">Choose Your Allergies:</h4>
    <div class="ttb-options">
      <ul>
      <ul>
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
          </ul>
      </ul>
      </div>
      </div>
      <!-- This button should show the results based on the selections -->
      <button class="button2" type="button" onclick="searchRecipes()">Search</button>
    </form>
    
    <h3>Results</h3>
    <hr>
    
    <!-- Recipe Ingredients Cards -->
    <!-- Here the recipes that match the search should be displayed -->
    <div class="ttb-card" id="recipeResults">
      <!-- Recipes will be dynamically loaded here -->
    </div>

    <script>
      function searchRecipes() {
  var form = document.getElementById('search');
  var formData = new FormData(form);

  var queryParams = new URLSearchParams(formData).toString();
  var url = 'RecipesSearch.php?' + queryParams;

  var xhr = new XMLHttpRequest();
  xhr.open('GET', url);
  xhr.onload = function() {
    if (xhr.status === 200) {
            document.getElementById('recipeResults').innerHTML = xhr.responseText;
          } else {
            console.log('Request failed. Status:', xhr.status);
          }
  };
  xhr.send();
}
 


    </script>
  </body>
</html>