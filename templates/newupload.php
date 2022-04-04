<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">  
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Sky Chen, Da Lin">
        <meta name="description" content="Recipes that work for you">  
        <title>Recipe Submitted!</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
        <link rel="stylesheet" href="styles/main.css">
    </head>
    <header>
        <nav>
            <a href="home.html">Recipick</a>
            <a href="search.html">Search</a>
            <a href="savedrecipes.html">Saved Recipes</a>
            <a href="myrecipes.html">My Recipes</a>
            <a href="profile.php">Profile</a>
        </nav>
    </header>
    <body>
        <div class="container" style="margin-top: 15px;">
            <div class="row col-xs-12">
                <h1>Recipe Submitted!</h1>
            </div>
           <div class="row col-xs-12">
                <pre>
                    <?php
                        $insert = $this->db->query("insert into recipes (RecipeName, EstimatedTime, Ingredients, Instructions, Author, user_id) values (?, ?, ?, ?, ?, ?);", 
                        "ssssss", $_POST["RecipeName"], $_POST["EstimatedTime"], 
                        $_POST["Ingredients"], $_POST["Instructions"],$_SESSION["name"], $_SESSION["id"]);
                        echo "<br>";
                        echo "Recipe Name: ".$_POST["RecipeName"];
                        echo "<br>";
                        echo "Estimated time: ".$_POST["EstimatedTime"];
                        echo "<br>";
                        echo "Ingredients: ".$_POST["Ingredients"];
                        echo "<br>";
                        echo "Instructions: ".$_POST["Instructions"];
                    ?>
                </pre>

                <button onclick = "location='myrecipes.html'" style="margin-left: 130px;">
                    Back
                </button>
                
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    </body>
</html>