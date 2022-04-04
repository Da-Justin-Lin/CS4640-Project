<?php

class RecipickController {
    private $command;

    private $db;
    
    private $logger;

    public function __construct($command) {
        $this->command = $command;

        $this->db = new Database();
    }

    public function run() {
        switch($this->command) {
            case "history":
                $this->displayrecipes();
                break;
            case "logout":
                $this->destroyCookies();
                break;
            case "new":
                $this->new();
                break;
            case "signup":
                $this->signup();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    private function displayrecipes() {
        $list = $this->db->query("select RecipeName, EstimatedTime, Rating from recipe where user_id = ? order by RecipeName desc;","s", $_SESSION["id"]);
        include("templates/myrecipes.php");
    }

    private function signup() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from recipick_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                $error_msg = "Email is already in use";
            } else { // empty, no user found
                // TODO: input validation
                // Note: never store clear-text passwords in the database
                //       PHP provides password_hash() and password_verify()
                //       to provide password verification
                $insert = $this->db->query("insert into recipick_user (name, email, password, num_recipes) values (?, ?, ?. ?);", 
                        "ssss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT), 0);
                $id = $this->db->query("select id from recipick_user where email = ?;", "s", $_POST["email"]);
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    $_SESSION["name"] =  $_POST["name"];
                    $_SESSION["email"] =   $_POST["email"];
                    $_SESSION["id"] = $id[0]["id"];
                    $_SESSION["num_recipes"] = $data[0]["num_recipes"];
                    header("Location: home.html");
                }
            }
        }
        include("templates/login.php");
    }

    private function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from recipick_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] =  $data[0]["name"];
                    $_SESSION["email"] =  $data[0]["email"];
                    $_SESSION["id"] = $data[0]["id"];
                    $_SESSION["num_recipes"] = $data[0]["num_recipes"];
                    header("Location: home.html");
                } else {
                    $error_msg = "Wrong password";
                }
            } else { // empty, no user found
                $error_msg = "User not found";
            }
        }
        include("templates/login.php");
    }


    private function new() {
        include("templates/newupload.php");
        if (isset($_POST["RecipeName"])) {
            $insert = $this->db->query("insert into recipes (RecipeName, EstimatedTime, Ingredients, Instructions, Rating, Author, user_id) values (?, ?, ?, ?, ?, ?);", 
            "ssssss", $_POST["RecipeName"], $_POST["EstimatedTime"], 
            $_POST["Ingredients"], $_POST["Instructions"], 0, $_SESSION["name"], $_SESSION["id"]);
            if ($insert === false) {
                $error_msg = "Error submitting recipe";
            } else {
                header("Location: ?command=history");
            }
        }   
    }
}