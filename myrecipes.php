<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <title>My Recipes</title>
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
        
        <a href="?command=newupload">New Upload</a>
        <!-- <button onclick = "command=newupload" style="margin-left: 10px;">
            Upload New
        </button> -->
        <br>
        <?php
            if (!empty($error_msg)) {
                echo "<div class='alert alert-danger'>$error_msg</div>";
            }else{
                echo "<table border='1'>
                <tr>
                <th>Recipe Name</th>
                <th>Estimated Time</th>
                <th>Rating</th>
                <th>Edit?</th>
                </tr>";
                foreach ($data as $item){
                    echo "<tr>";
                    echo "<td>" . $item['RecipeName'] . "</td>";
                    echo "<td>" . $item['EstimatedTime'] . "</td>";
                    echo "<td>" . 0 . "</td>";
                    echo "<td>" . "Edit?" . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        ?>
        <hr>
    </body>