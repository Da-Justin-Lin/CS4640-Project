<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <title>Recipick</title>
            <meta name="author" content="Sky Chen/Da Lin">
            <meta name="description" content="recipes">
            <meta name="keywords" content="food">
            <meta name="contributions" content="Sky: search, savedrecipes, myrecipes, both profiles; Da: index, login, home, recipedetails, newupload, edit recipes"> 
            <link rel="stylesheet" href="styles/main.css">
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
            <h1 style="font-size: 70px; text-align: center;">
                Recipick
            </h1>
            <form action="?command=displayProfile" method="post">
                <input type="number" id="amount" name="amount">
                <button type="submit" class="btn btn-primary">profile</button>
            </form>
        </body>
</html>