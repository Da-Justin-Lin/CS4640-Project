<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="contributions" content="Sky: login, display ratings, display recipe count, saved recipes. Da: display table, edit recipes, new upload">
    <title>Recipick</title>
    <link rel="stylesheet" type="text/css" href="styles/index.css" />
    <!-- https://cs4640.cs.virginia.edu/sc4rdz/Recipick -->
    <!-- https://cs4640.cs.virginia.edu/dl2de/Recipick -->
</head>
<?php
session_start();
// Register the autoloader
spl_autoload_register(function($classname) {
    include "classes/$classname.php";
});

// Parse the query string for command
$command = "index";
if (isset($_GET["command"]))
    $command = $_GET["command"];

// If the user's email is not set in the cookies, then it's not
// a valid session (they didn't get here from the login page),
// so we should send them over to log in first before doing
// anything else!
//if (!isset($_COOKIE["email"])) {
    // they need to see the login
 //   $command = "login";
//}
// Instantiate the controller and run
$finance = new RecipickController($command);
$finance->run();