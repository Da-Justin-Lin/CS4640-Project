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
        if (!isset($_GET['command'])){
            $this->login();
        }else{
        switch($_GET['command']) {
            case "myrecipes":
                $this->displayrecipes();
                break;
            case "newupload":
                $this->newupload();
                break;
            case "search":
                $this->search();
                break;
            case "saved":
                $this->saved();
                break;
            case "profile":
                $this->displayProfile();
                break;
            case "logout":
                $this->logout();
                break;
            case "new":
                $this->new();
                break;
            case "signup":
                $this->signup();
                break;
            case "home":
                $this->home();
                break;
            case "edit":
                $this->edit();
                break;
            case "delete":
                $this->delete();
                break;
            case "login":
            default:
                $this->login();
                break;
        }}
    }

    private function newupload() {
        include("newupload.php");
    }
    private function logout() {
        session_unset();
        session_destroy();
        header("Location: ?command=login");
    }

    private function search() {
        include("search.php");
    }

    private function saved() {
        $data2 = $this->db->query("select id, RecipeName, EstimatedTime, Author from saved where saved_user = ?;", "s", $_SESSION["id"]);
        include("savedrecipes.php");
    }

    private function displayProfile() {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $data = $this->db->query("select id from recipes where user_id = ?;", "s", $_SESSION["id"]);
        $data_json = json_encode($data);
        $num_recipes = 0;
        foreach ($data as $c) {
            $num_recipes++;
        }
        $data1 = $this->db->query("select rating from ratings where user_id = ?;", "s", $_SESSION["id"]);
        $data1_json = json_encode($data1);
        $total = 0;
        $count = 0;
        foreach($data1 as $d) {
            $total += $d["rating"];
            $count++;
        }
        if ($count == 0) {
            $rate = 0;
        }else {
            $rate = $total/$count;
        }
        include("profile.php");
    }

    private function displayrecipes() {
        $data = $this->db->query("select RecipeName, EstimatedTime, id from recipes where user_id = ?;", "s", $_SESSION["id"]);
        //$list = $this->db->query("select RecipeName, EstimatedTime, Rating from recipes where user_id = ? order by RecipeName desc;","s", $_SESSION["id"]);
        include("myrecipes.php");
    }

    private function signup() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from recipick_user where email = ?;", "s", $_POST["email"]);
            $data_json = json_encode($data);
            if ($data === false) {
                $error_msg = "Error checking for user";
            }
            else if ( ($_POST["email"] == "") || ($_POST["name"] == "") || ($_POST["password"] == "") ){
                $error_msg = "Don't leave signup fields blank";
            }
            else if (!empty($data)) {
                $error_msg = "Email is already in use";
            } else { // empty, no user found
                // TODO: input validation
                // Note: never store clear-text passwords in the database
                //       PHP provides password_hash() and password_verify()
                //       to provide password verification
                $insert = $this->db->query("insert into recipick_user (name, email, password, num_recipes) values (?, ?, ?, ?);", 
                        "ssss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT), 0);
                $id = $this->db->query("select id from recipick_user where email = ?;", "s", $_POST["email"]);
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    session_start();
                    $_SESSION["name"] =  $_POST["name"];
                    $_SESSION["email"] =   $_POST["email"];
                    $_SESSION["id"] = $id[0]["id"];
                    header("Location: ?command=home");
                }
            }
        }
        include("login.php");
    }

    private function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from recipick_user where email = ?;", "s", $_POST["email"]);
            $data_json = json_encode($data);
            if ($data === false) {
                $error_msg = "Error checking for user";
            }
            else if ( ($_POST["email"] == "") || ($_POST["password"] == "") ){
                $error_msg = "Don't leave login fields blank";
            }
            else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    session_start();
                    $_SESSION["name"] =  $data[0]["name"];
                    $_SESSION["email"] =  $data[0]["email"];
                    $_SESSION["id"] = $data[0]["id"];
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Wrong password";
                }
            } else { // empty, no user found
                $error_msg = "User not found";
            }
        }
        include("login.php");
    }


    private function new() {
        if (isset($_POST["RecipeName"])) {
            if (($_POST["RecipeName"] == "") || ($_POST["EstimatedTime"] == "") || ($_POST["Ingredients"] == "") || ($_POST["Instructions"] == "")) {
                $error_msg = "Fill out all the fields";
            }
            else {
                $insert = $this->db->query("insert into recipes (RecipeName, EstimatedTime, Ingredients, Instructions, Author, user_id) values (?, ?, ?, ?, ?, ?);", 
                "ssssss", $_POST["RecipeName"], $_POST["EstimatedTime"], 
                $_POST["Ingredients"], $_POST["Instructions"], $_SESSION["name"], $_SESSION["id"]);
    
                if ($insert === false) {
                    $error_msg = "Error submitting recipe";
                } else {
                    header("Location: ?command=myrecipes");
                }
            }
        }   
        include("newupload.php");
    }

    private function edit(){
        $recipe_id = $_GET['id'];
        $recipe = $this->db->query("select * from recipes where id = ?;", "s", $recipe_id)[0];
        if (isset($_POST["RecipeName"])) {
            $RecipeName = $_POST['RecipeName'];
            $EstimatedTime = $_POST['EstimatedTime'];
            $Ingredients = $_POST['Ingredients'];
            $Instructions = $_POST['Instructions'];
            $name = $_SESSION['name'];
            $id = $_SESSION['id'];

            $insert = $this->db->query("UPDATE recipes set RecipeName = '$RecipeName', EstimatedTime = '$EstimatedTime', Ingredients = '$Ingredients', Instructions = '$Instructions' where id = $recipe_id;");

            // $insert = $this->db->query("update recipes set (RecipeName, EstimatedTime, Ingredients, Instructions, Author, user_id) values (?, ?, ?, ?, ?, ?) where id=?;", 
            // "sssssss", $_POST["RecipeName"], $_POST["EstimatedTime"], 
            // $_POST["Ingredients"], $_POST["Instructions"], $_SESSION["name"], $_SESSION["id"], $recipe_id);
            if ($insert === false) {
                $error_msg = "Error submitting recipe";
            } else {
                header("Location: ?command=myrecipes");
            }
        }
        include("editrecipes.php");
    }

    private function delete(){
        $recipe_id = $_GET['id'];
        $insert = $this->db->query("DELETE FROM recipes WHERE id=$recipe_id;");
        header("Location: ?command=myrecipes");
        include("editrecipes.php");
    }

    private function home(){
        include("home.php");
    }
}