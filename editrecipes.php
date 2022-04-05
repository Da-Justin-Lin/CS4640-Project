<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Edit Recipes</title>
        <meta name="author" content="Sky Chen/Da Lin">
        <meta name="description" content="A place to find recipes that work for you.">
        <meta name="keywords" content="food">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/newupload.css">
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

        <label style = "font-size: 30px">Recipe Name:</label>
        <input type="text" id="RecipeName" name="RecipeName">
        <label style = "font-size: 20px; margin-left: 50px;">Estimated time:</label>
        <input type="text" id="estimatedtime" name="estimatedtime">
        <br>

        <label style = "font-size: 30px">Ingredients:</label>
        <br>
        <textarea name="Text1" cols="80" rows="6"></textarea>
        <br>

        <label style = "font-size: 30px">Instructions:</label>
        <br>
        <textarea name="Instructions" cols="80" rows="10"></textarea>
        <br>

        <button onclick = "location='myrecipes.html'" style="margin-left: 10px;">
            Submit
        </button>

        <button onclick = "location='myrecipes.html'" style="margin-left: 10px; background-color: rgb(255, 166, 166);">
            Delete
        </button>
    </body>
</html>