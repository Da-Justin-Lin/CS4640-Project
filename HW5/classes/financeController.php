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
                $this->login();
            case "new":
                $this->new();
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
            $data = $this->db->query("select * from hw5_user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) {
                if (password_verify($_POST["password"], $data[0]["password"])) {
                    setcookie("name", $data[0]["name"], time() + 3600);
                    setcookie("email", $data[0]["email"], time() + 3600);
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
                if ($insert === false) {
                    $error_msg = "Error inserting user";
                } else {
                    setcookie("name", $_POST["name"], time() + 3600);
                    setcookie("email", $_POST["email"], time() + 3600);
                    setcookie("score", 0, time() + 3600);
                    header("Location: ?command=history");
                }
            }
        }
        include("templates/login.php");
    }

    private function history() {
        $data = $this->db->query("select * from hw5_transaction where user_id = ? order by t_date desc;");
        $data2 = $this->db->query("select sum(amount) as balance from hw5_transaction where user_id = ?;");
        $data3 = $this->db->query("select category, sum(amount) as balance from hw5_transaction group by category;");
        include("templates/history.php");
    }

    private function new() {
        if (isset($_POST["trans_type"])) {
            // if credit, amount is positive
            if ($_POST["trans_type"] == "credit") {
                $insert = $this->db->query("insert into hw5_transaction (name, trans_name, trans_cat, date, amount, trans_type) values (?, ?, ?, ?, ?, ?);", 
                "ssssss", $_POST["name"], $_POST["trans_name"], $_POST["trans_cat"], 
                $_POST["date"], $_POST["amount"], $_POST["trans_type"]);
            }
            // if debit, amount is negative
            else {
                $insert = $this->db->query("insert into hw5_transaction (name, trans_name, trans_cat, date, amount, trans_type) values (?, ?, ?, ?, ?, ?);", 
                "ssssss", $_POST["name"], $_POST["trans_name"], $_POST["trans_cat"], 
                $_POST["date"], -1*$_POST["amount"], $_POST["trans_type"]);
            }
        }
        if ($insert === false) {
            $error_msg = "Error inserting transaction";
        } else {
            header("Location: ?command=new");
        }
    }
}