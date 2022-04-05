<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Profile</title>
        <meta name="author" content="Sky Chen/Da Lin">
        <meta name="description" content="A place to find recipes that work for you.">
        <meta name="keywords" content="food">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/profile.css">
    </head> 
    <body>
        <header>
            <nav>
                <a href="home.html">Recipick</a>
                <a href="search.html">Search</a>
                <a href="savedrecipes.html">Saved Recipes</a>
                <a href="myrecipes.html">My Recipes</a>
                <a href="profile.php">Profile</a>
            </nav>
        </header>
        <p>Username: <?=$name?></p>
        <p>Email: <?=$email?></p>
        <p>Average Ratings: 0</p> 
        <p>Number of Recipes: <?=$num_recipes?> </p>

        <button onclick = "location='index.html'" style="margin-left: 20px;">
            Log out
        </button>
    </body>
</html>