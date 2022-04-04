<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1"> 
            <title>Login</title>
            <meta name="author" content="Sky Chen/Da Lin">
            <meta name="description" content="recipes">
            <meta name="keywords" content="food">
            <link rel="stylesheet" href="styles/main.css">
            <link rel="stylesheet" href="styles/login.css">
        </head> 
        <body>
            <header>
                <nav>
                        <a href="index.html">Recipick</a>
                </nav>
            </header>
            <div class = "flex-container">
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="?command=login" method="post">
                    <h1 style = "font-size: 60px;display:inline-block">
                        Login
                    </h1>
                    <br>
                    <label for="Email" style = "font-size: 30px">E-mail:</label>
                    <input type="text" id="Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <br>
                    <label for="Password" style = "font-size: 30px">Password:</label>
                    <input type="password" id="Password" name="Password">
                    <br>
                    <button type="upload" style="margin-left: 10px;">
                        <a href="home.html" style = "text-decoration: None;">Login</a>
                    </button>
                </form>
                <?php
                    if (!empty($error_msg)) {
                        echo "<div class='alert alert-danger'>$error_msg</div>";
                    }
                ?>
                <form action="?command=signup" method="post">
                    <h1 style = "font-size: 60px">
                        Sign up
                    </h1>
                    <label for="Username" style = "font-size: 30px">Username:</label>
                    <input type="text" id="Username" name="Username">
                    <br>
                    <label for="Email" style = "font-size: 30px" >E-mail:</label>
                    <input type="text" id="Email" name="Email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                    <br>
                    <label for="Password" style = "font-size: 30px">Password:</label>
                    <input type="password" id="password" name="password" pattern=".{8,}">
                    <br>
                    <label for="confirm_Password" style = "font-size: 30px">Confirm Password:</label>
                    <input type="password" id="confirm_Password" name="confirm_Password">
                    <br>
                    <button type="upload" style="margin-left: 10px;">
                        <a href="home.html" style = "text-decoration: None;">Create Account</a>
                    </button>
                </form>
            </div>
        </body>
</html>