<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Search</title>
        <meta name="author" content="Sky Chen/Da Lin">
        <meta name="description" content="A place to find recipes that work for you.">
        <meta name="keywords" content="food">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/search.css">
    </head> 
    
    <body>
        <header>
            <nav>
                <a href="?command=home">Recipick</a>
                <a href="?command=search">Search</a>
                <a href="?command=saved">Saved Recipes</a>
                <a href="?command=myrecipes">My Recipes</a>
                <a href="?command=profile">Profile</a>
            </nav>
        </header>
        <form class = "searchplace" action="?command=search" method="post">
            <label for="recipename"> Search Recipes by Name:</label>
            <br>
            <input type="text" id="recipename" name ="recipename" placeholder="Enter recipe name">
            <br>
            <label for="recipeingredients"> Search Recipes by Ingredients (seperate ingredients with semicolons):</label>
            <br>
            <input type="text" id="recipeingredients" name ="recipeingredients" placeholder="Enter available ingredients">
            <br>
            <label for="fav"> Only search favorites?</label>
            <input type="checkbox" id="fav" name="fav" value="Favorite">
<<<<<<< Updated upstream
            <input type="button" class="btn btn-primary" value="New Game" onclick="passVal();"/>
=======
            <button type="submit" style="margin-left: 340px;">Search</button> 
        </form>
>>>>>>> Stashed changes
        </div>
        <br>
        <br>
       <!--
        <table>
            <tr>
                <th>&nbsp; Recipe Name &nbsp;</th>
                <th>&nbsp; Estimated Time &nbsp;</th>
                <th>&nbsp; Uploader &nbsp;</th>
                <th>&nbsp; Rating &nbsp;</th>
            </tr>
        </table>
        <hr>
        -->
        <?php
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }else {
                if(sizeof($listRecipe) == 0) {
                    echo "No search results match your query";
                }
                else {
                    echo "<table border='1px solid black'>
                    <tr>
                    <th>Recipe Name</th>
                    <th>Estimated Time</th>
                    <th>Uploader</th>
                    <th>Rating</th>
                    <th>View?</th>
                    </tr>";
                    foreach($listRecipe as $rec) {
                        $rate = $this->db->query("select rating from ratings where recipe_id = ?;", "s", $rec["id"]);
                        $count = 0;
                        $total = 0;
                        foreach ($rate as $r) {
                            $total += $r["rating"];
                            $count++;
                        }
                        if ($count == 0) {
                            $rate = 0;
                        }else {
                            $rate = $total/$count;
                        }
                        $id = $rec['id'];
                        echo "<tr>";
                        echo "<td style='text-align:center;'>" . $rec["RecipeName"] . "</td>";
                        echo "<td style='text-align:center;'>" . $rec["EstimatedTime"] . "</td>";
                        echo "<td style='text-align:center;'>" . $rec["Author"] . "</td>";
                        echo "<td style='text-align:center;'>" .  $rate  . "</td>";
                        echo "<td style='text-align:center;'>" .  "<a href='?command=view&id=$id'>View</a>"  . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    }
                }
                
            ?>
    </body>
</html>

