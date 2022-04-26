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
        <div class="searchplace">
            <label for="recipename"> Search Recipes by Name:</label>
            <br>
            <input type="text" id="recipename" placeholder="Enter recipe name">
            <br>
            <label for="recipeingredients"> Search Recipes by Ingredients:</label>
            <br>
            <input type="text" id="recipeingredients" placeholder="Enter available ingredients">
            <br>
            <label for="fav"> Only search favorites?</label>
            <input type="checkbox" id="fav" name="fav" value="Favorite">
            <input type="button" class="btn btn-primary" value="New Game" onclick="passVal();"/>
        </div>
        <br>
        <br>
        <table>
            <tr>
                <th>&nbsp; Recipe Name &nbsp;</th>
                <th>&nbsp; Estimated Time &nbsp;</th>
                <th>&nbsp; Uploader &nbsp;</th>
                <th>&nbsp; Rating &nbsp;</th>
            </tr>
        </table>
        <hr>
    </body>
</html>