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
        <table>
            <tr>
                <th>&nbsp; Recipe Name &nbsp;</th>
                <th>&nbsp; Estimated Time &nbsp;</th>
                <th>&nbsp;Rating &nbsp;</th>
                <th>&nbsp; Edit? &nbsp;</th>
            </tr>
        </table>
        <hr>
    </body>