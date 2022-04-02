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
                break;
            case "new":
                $this->new();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    private function destroyCookies() {
        session_unset();
        session_destroy();
        header("Location: ?command=login");
    }

    private function login() {
        if (isset($_POST["email"])) {
            $data = $this->db->query("select * from hw5_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    $_SESSION["name"] =  $data[0]["name"];
                    $_SESSION["email"] =  $data[0]["email"];
                    $_SESSION["id"] = $data[0]["id"];
                    header("Location: ?command=history");
                } else {
                    $error_msg = "Wrong password";
                }
            } else { // empty, no user found
                // TODO: input validation
                // Note: never store clear-text passwords in the database
                //       PHP provides password_hash() and password_verify()
                //       to provide password verification
                $insert = $this->db->query("insert into hw5_user (name, email, password) values (?, ?, ?);", 
                        "sss", $_POST["name"], $_POST["email"], 
                        password_hash($_POST["password"], PASSWORD_DEFAULT));
                $id = $this->db->query("select id from hw5_user where email = ?;", "s", $_POST["email"]);
                print_r($id);
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    $_SESSION["name"] =  $_POST["name"];
                    $_SESSION["email"] =   $_POST["email"];
                    $_SESSION["id"] = $id[0]["id"];
                    header("Location: ?command=history");
                }
            }
        }
        include("templates/login.php");
    }

    private function history() {
        $name = $_SESSION["name"];
        $email = $_SESSION["email"];
        $list = $this->db->query("select trans_name, trans_cat, t_date, amount, trans_type from hw5_transaction where user_id = ? order by t_date desc;","s", $_SESSION["id"]);
        if ($list === false){
            $error_msg = "No data from this user.";
        }else{
            $total_bal = $this->db->query("select sum(amount) as balance from hw5_transaction where user_id = ?;","s", $_SESSION["id"]);
            $cat_bal = $this->db->query("select trans_cat, sum(amount) as balance from hw5_transaction where user_id = ? group by trans_cat;", "s",$_SESSION["id"]);
        }
        include("templates/history.php");
    }

    private function new() {
        include("templates/new.php");
        if (isset($_POST["trans_type"])) {
            // if credit, amount is positive
            if ($_POST["trans_type"] == "Credit") {
                $insert = $this->db->query("insert into hw5_transaction (trans_name, trans_cat, t_date, amount, trans_type, user_id) values (?, ?, ?, ?, ?, ?);", 
                "ssssss", $_POST["trans_name"], $_POST["trans_cat"], 
                $_POST["date"], $_POST["amount"], $_POST["trans_type"], $_SESSION["id"]);
            }
            // if debit, amount is negative
            else {
                $insert = $this->db->query("insert into hw5_transaction (trans_name, trans_cat, t_date, amount, trans_type, user_id) values (?, ?, ?, ?, ?, ?);", 
                "ssssss", $_POST["trans_name"], $_POST["trans_cat"], 
                $_POST["date"], -1*$_POST["amount"], $_POST["trans_type"], $_SESSION["id"]);
            }
            if ($insert === false) {
                $error_msg = "Error inserting transaction";
            } else {
                header("Location: ?command=history");
            }
        }
        
    }
}