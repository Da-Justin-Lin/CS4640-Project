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

        <form action="?command=edit&id=<?=$recipe_id?>" method="post">
            <label for="RecipeName" style = "font-size: 30px; margin-left:20px">Recipe Name:</label>
            <input type="text" id="RecipeName" name="RecipeName" pattern=".{2,}" value="<?php echo $recipe["RecipeName"]; ?>">
            <label for="EstimatedTime" style = "font-size: 30px; margin-left: 50px;">Estimated time:</label>
            <input type="text" id="EstimatedTime" name="EstimatedTime" pattern=".{2,}" value="<?php echo $recipe["EstimatedTime"]; ?>">
            <br>
            <label for="Ingredients" style = "font-size: 30px; margin-left:20px;">Ingredients:</label>
            <br>

            <textarea name="Ingredients" id="Ingredients" cols="80" rows="6" pattern=".{2,}">
                <?php echo $recipe["Ingredients"]; ?>
            </textarea>
            
            <br>
            <label for="Instructions" style = "font-size: 30px; margin-left:20px;">Instructions:</label>
            <br>

            <textarea name="Instructions" id="Instructions" cols="80" rows="10" pattern=".{2,}">
            <?php echo $recipe["Instructions"]; ?>
            </textarea>

            <br>
            <button type = "submit" style="margin-left: 130px;">
                Submit
            </button>
        </form>
        <form action="?command=delete&id=<?=$recipe_id?>" method = "post" onsubmit="return pop()">
            <button type = "submit" id="delete" style="margin-left: 10px; background-color: rgb(255, 166, 166);" >
                Delete
            </button>
        </form>
    </body>
    <script type="text/javascript">
            function pop(){
                var answer = window.confirm("Delete recipe?");
                if (answer) {
                    this.form.submit();
                }
                else {
                    return false;
                }
                            }
    </script>
</html>