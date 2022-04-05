<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Upload New Recipes</title>
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

        <form action="?command=new" method="post">
            <label for="RecipeName" style = "font-size: 30px; margin-left:20px">Recipe Name:</label>
            <input type="text" id="RecipeName" name="RecipeName" pattern=".{2,}">
            <label for="EstimatedTime" style = "font-size: 30px; margin-left: 50px;">Estimated time:</label>
            <input type="text" id="EstimatedTime" name="EstimatedTime" pattern=".{2,}">
            <br>
            <label for="Ingredients" style = "font-size: 30px; margin-left:20px;">Ingredients:</label>
            <br>
            <textarea name="Ingredients" id="Ingredients" cols="80" rows="6" pattern=".{2,}"></textarea>
            <br>
            <label for="Instructions" style = "font-size: 30px; margin-left:20px;">Instructions:</label>
            <br>
            <textarea name="Instructions" id="Instructions" cols="80" rows="10" pattern=".{2,}"></textarea>
            <br>
            <label for="photo" style = "font-size: 30px; margin-left:20px;">Upload Image:</label>
            <input type="file"
                id="photo" name="photo"
                accept="image/*">
            <button type = "submit" style="margin-left: 130px;">
                Submit
            </button>
        </form>
    </body>
</html>