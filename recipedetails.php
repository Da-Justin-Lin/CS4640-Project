<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>Recipe Details</title>
        <meta name="author" content="Sky Chen/Da Lin">
        <meta name="description" content="A place to find recipes that work for you.">
        <meta name="keywords" content="food">
        <link rel="stylesheet" href="styles/main.css">
        <link rel="stylesheet" href="styles/newupload.css">
    </head> 
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
	crossorigin="anonymous">
    </script>
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

        <label for="RecipeName" style = "font-size: 30px">Recipe Name:</label>
        <?php echo $recipe["RecipeName"]; ?>
        <label for="estimatedtime" style = "font-size: 20px; margin-left: 50px;">Estimated time:</label>
        <?php echo $recipe["EstimatedTime"]; ?>
        <br>

        <label for="Text1" style = "font-size: 30px">Ingredients:</label>
        <?php echo $recipe["Ingredients"]; ?>
        <br>
        <br>

        <label for="Instructions" style = "font-size: 30px">Instructions:</label>
        <?php echo $recipe["Instructions"]; ?>
        <br>
        <br>
        <i id="star1" color="green"> <span style="font-size:300%;">&starf;</span> </i>
        <i id="star2" color="green"> <span style="font-size:300%;">&starf;</span> </i>
        <i id="star3" color="green"> <span style="font-size:300%;">&starf;</span> </i>
        <i id="star4" color="green"> <span style="font-size:300%;">&starf;</span> </i>
        <i id="star5" color="green"> <span style="font-size:300%;">&starf;</span> </i>
        <form action="?command=submitRating&id=<?=$recipe_id?>" method="post" onsubmit="return pop()">
            <input id ='rating' name='rating' type="text" hidden>
            <button type="submit" id="submitRating"> Submit Rating </button>
        </form>
        <script type="text/javascript">
        function pop() {
            if(document.getElementById('rating').value == 0) {
                alert("You must rate the recipe before you submit!");
                return false;
            }
            var answer = window.confirm("Submit this rating?");
            if(answer) {
                this.form.submit();
            }
            else {
                return false;
            }
        }

        $(document).ready(function() {
            var rate = 0;
            document.getElementById('rating').value = rate;
            $("#star1").click(function() {
                $("#star1").css("color", "green");
                $("#star2, #star3, #star4, #star5").css("color", "black");
                rate = 1;
                document.getElementById('rating').value = rate;
            });
            $("#star2").click(function() {
                $("#star1, #star2").css("color", "green");
                $("#star3, #star4, #star5").css("color", "black");
                rate = 2;
                document.getElementById('rating').value = rate;
            });
            $("#star3").click(function() {
                $("#star1, #star2, #star3").css("color", "green");
                $("#star4, #star5").css("color", "black");
                rate = 3;
                document.getElementById('rating').value = rate;
            });
            $("#star4").click(function() {
                $("#star1, #star2, #star3, #star4").css("color", "green");
                $("#star5").css("color", "black");
                rate = 4;
                document.getElementById('rating').value = rate;
            });
            $("#star5").click(function() {
                $("#star1, #star2, #star3, #star4, #star5").css("color", "green");
                rate = 5;
                document.getElementById('rating').value = rate;
            });
            $("#submitRating").click(function() {
                if(rate = 0) {
                    alert("You must rate the recipe before you submit!");
                }
            });
        });
        </script>
    </body>

</html>