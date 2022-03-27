<?php

class FinanceController {
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
                $this->history();
                break;
            case "logout":
                $this->destroyCookies();
            case "login":
            case "new":
                $this->new();
                break;
            default:
                $this->login();
        }
    }

    private function destroyCookies() {
        setcookie("name", "", time() - 3600);
        setcookie("email", "", time() - 3600);
    }

    private function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    setcookie("name", $data[0]["name"], time() + 3600);
                    setcookie("email", $data[0]["email"], time() + 3600);
                    header("Location: ?command=question");
                } else {
                    $error_msg = "Wrong password";
                }
            } else { // empty, no user found
                // TODO: input validation
                // Note: never store clear-text passwords in the database
                //       PHP provides password_hash() and password_verify()
                //       to provide password verification
                $insert = $this->db->query("insert into user (name, email, password) values (?, ?, ?);", 
                        "sss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    setcookie("name", $_POST["name"], time() + 3600);
                    setcookie("email", $_POST["email"], time() + 3600);
                    setcookie("score", 0, time() + 3600);
                    header("Location: ?command=question");
                }
            }
        }
        include("templates/login.php");
    }

    private function history() {
        $user = [
            "name" => $_COOKIE["name"],
            "email" => $_COOKIE["email"],
            "score" => $_COOKIE["score"]
        ];

        $message = "";
        if (isset($_POST["answer"])) {
            $answer = $_POST["answer"];
            // look up the question that the user answered
            $data = $this->db->query("select answer from question where id = ?;", "i", $_POST["questionid"]);
            if ($data === false) {
                $message = "<div class='alert alert-danger'>An error occurred</div>";
            } else if (!isset($data[0])) {
                $message = "<div class='alert alert-danger'>That question didn't exist</div>";
            } else if ($data[0]["answer"] == $_POST["answer"]) {
                $message = "<div class='alert alert-success'><b>$answer</b> was correct!</div>";

                $user["score"] += 10;
                setcookie("score", $user["score"], time() + 3600);
                $this->db->query("update user set score = ? where email = ?;", "is", $user["score"], $user["email"]);
            } else {
                $message = "<div class='alert alert-danger'><b>$answer</b> was incorrect.  The correct was {$data[0]["answer"]}.</div>";
            }
        }
        include("templates/question.php");
    }

    private function new() {
        $insert = $this->db->query("insert into user (name, trans_name, trans_cat, date, amount, trans_type) values (?, ?, ?);", 
                        "ssssss", $_POST["name"], $_POST["trans_name"], $_POST["trans_cat"], 
                        $_POST["date"],$_POST["amount"], $_POST["trans_type"]);
                if ($insert === false) {
                    $error_msg = "Error inserting transaction";
                } else {
                    header("Location: ?command=new");
                }
    }
}