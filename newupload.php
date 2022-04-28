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
                <a href="?command=myrecipes">My Recipes</a>
                <a href="?command=profile">Profile</a>
            </nav>
        </header>
        <?php
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }
        ?>
        <form action="?command=new" method="post">
            <label for="RecipeName" style = "font-size: 30px; margin-left:20px">Recipe Name:</label>
            <input type="text" id="RecipeName" name="RecipeName" pattern=".{2,}">
            <label for="EstimatedTime" style = "font-size: 30px; margin-left: 50px;">Estimated time:</label>
            <input type="text" id="EstimatedTime" name="EstimatedTime" pattern=".{2,}">
            <p id="pwhelp" class="form-text" style = "color:red"></p>
            <br>
            <label for="Ingredients" style = "font-size: 30px; margin-left:20px;">Ingredients:</label>
            <br>
            <textarea name="Ingredients" id="Ingredients" cols="80" rows="6" pattern=".{2,}"></textarea>
            <br>
            <label for="Instructions" style = "font-size: 30px; margin-left:20px;">Instructions:</label>
            <br>
            <textarea name="Instructions" id="Instructions" cols="80" rows="10" pattern=".{2,}"></textarea>
            <br>
            <button id="submit" name="submit" type = "submit" style="margin-left: 130px;">
                Submit
            </button>
        </form>
    </body>

    <script type="text/javascript">
            document.getElementById("EstimatedTime").addEventListener("keyup", function() {
                var estimate= document.getElementById("EstimatedTime");
                var submit = document.getElementById("submit");
                var pwhelp = document.getElementById("pwhelp");
                var estimateval = estimate.value;

                if (!checktime(estimateval)) {
                    estimate.classList.add("is-invalid");
                    submit.disabled = true;
                    pwhelp.textContent = "Please enter a valid time with number and minutes, hours, etc.";
                } else {
                    estimate.classList.remove("is-invalid");
                    submit.disabled = false;
                    pwhelp.textContent = "";
                }
            });

            let checktime = (time) =>{
                var re = /([0-9]+(\s)?(sec|second|seconds|min|minute|minutes|hr|hour|hours|day|days))+/i;
                return re.test(time);
            };
    </script>
</html>