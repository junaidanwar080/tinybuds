<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <link rel="stylesheet" href="ViewMyAccount.css">

</head>
<body>
    <div class="sidenav">
        <div class="profile">
            <img src="https://cdn.icon-icons.com/icons2/3054/PNG/512/account_profile_user_icon_190494.png" alt="" width="100" height="100">
        </div>

        <div class="sidenav-url">
            <div class="url">
                <a href="#profile" class="active">Edit Profile</a>
                <hr align="center">
            </div>
            <div class="url">
                <a href="#settings">Settings</a>
                <hr align="center">
            </div>
        </div>
    </div>
    <div class="main">
        <h2>MY PROFILE</h2>
        <div class="card">
            <div class="card-body">
                <i class="fa fa-pen fa-xs edit"></i>
                <table>
                    <?php             
                    include('connect.php');
                    
                    session_start();
                    if (!isset($_SESSION['username'])|| $_SESSION['loggedin'] !== true) {
                       
                        header("Location: LogInPage.php"); 
                        exit(); 
                    }
                    if (isset($_SESSION['username'])) {
                        $username = $_SESSION['username'];
                        $sql = "SELECT Name, Email, 'Parent' AS role FROM parent WHERE Name = '$username' or Email='$username'
                        UNION ALL
                        SELECT Name, Email, 'Dietitian' AS role FROM dietitian WHERE Name = '$username'or Email='$username'
                        UNION ALL
                        SELECT Name, Email, 'Admin' AS role FROM admin WHERE Name = '$username'or Email='$username';";
                    
                
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                
                  $name = $row["Name"] ?? '';
                  $email = $row["Email"] ?? '';
                  $role = $row["role"]; 
                       
                   
                }
            }
                    ?>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><?php echo $name ?? ''; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><?php echo $email ?? ''; ?></td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td><?php echo $role ?? ''; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <h2>MY INFORMATION</h2>
        <div class="card">
        
        <div class="w3-bar w3-black">
          <button class="w3-bar-item w3-button" onclick="openInfo('recipies')">Recipes</button>
          <button class="w3-bar-item w3-button" onclick="openInfo('bookmarks')">Bookmarks</button>
          <button class="w3-bar-item w3-button" onclick="openInfo('posts')">Posts</button>
        </div >
            <div id="recipies" class="info">
                <h2>My Recipes</h2>
                
                <div class="recipes-container">
                    <?php
                    $sql = "SELECT * FROM Recipe WHERE ParentID = (SELECT ID FROM Parent WHERE Name = '$username' or Email='$username')
                            OR DietitianID = (SELECT ID FROM Dietitian WHERE Name = '$username' or Email='$username')";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $recipeId = $row["ID"];
                            $recipeTitle = $row["RecipeTitle"];
                            $description = $row["Description"];
                            $recipePhoto = isset($row["photo"]) ? $row["photo"] : null;

                            echo "<div class='recipe'>";
                            echo "<div class='recipe-image'>";
                            if ($recipePhoto) {
                                $photoSrc = 'data:image/jpeg;base64,' . base64_encode($recipePhoto);
                                echo "<a href='recipe_details.php?recipe_id= $recipeId  ; '>";
                                echo "<img src=". $photoSrc ." alt='Photo'>";
                                echo "</a>";
                            } else {
                                echo "<a href='recipe_details.php?recipe_id=$recipeId; '>";
                                echo "<img src='default_photo.png' alt='Default Recipe Photo'>";
                                echo "</a>";
                            }
                            echo "<div class='recipe-title'>$recipeTitle</div>";
                            echo "<form method='post' action='editRecipes.php'> 
                <input type='hidden' name='recipe-id' value='$recipeId'>
                <input type='submit' name='edit-recipe' value='Edit'>
              </form>";
                            echo "<form method='post' action='php\deleteRecipe.php'>
                <input type='hidden' name='recipe-id' value='$recipeId'>
                <input type='submit' name='delete-recipe' value='Delete'>
              </form>";

                            echo "</div>";
                            echo "</div>";
                            
                        }
                    } else {
                        echo "<p>No recipes found.</p>";
                    }
                    ?>
                </div>  
              
              </div>
              
              <div id="bookmarks" class="info" style="display:none">
                <h2>My Bookmarks</h2>
                <p class="infop">Here will be the users Bookmarks</p>
              </div>
              
              <div id="posts" class="info" style="display:none">
                <h2>My Posts</h2>
                <p class="infop">Here will be the users Posts</p>
                
            </div>
            
    </div>
    <button class="link-button" onclick="window.location.href='RecipeForm.php'">Add Recipe</button>
</div> 


      <script>
      function openInfo(getInfo) {
        var i;
        var x = document.getElementsByClassName("info");
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        document.getElementById(getInfo).style.display = "block";
      }</script>
</body>
</html>