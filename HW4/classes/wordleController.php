<?php
class wordleController {

    private $command;

    public function __construct($command) {
        $this->command = $command;
    }

    public function run() {
        switch($this->command) {
            case "question":
                $this->question();
                break;
            case "logout":
                $this->destroyCookies();
            case "login":
            default:
                $this->login();
                break;
        }
    }

    // Clear all the cookies that we've set
    private function destroyCookies() {          
        setcookie("correct", "", time() - 3600);
        setcookie("name", "", time() - 3600);
        setcookie("email", "", time() - 3600);
        setcookie("num_guess", "", time() - 3600);
        setcookie("word", "", time() - 3600);
    }
    

    // Display the login page (and handle login logic)
    public function login() {
        if (isset($_POST["email"]) && !empty($_POST["email"])) { /// validate the email coming in
            setcookie("name", $_POST["name"], time() + 3600);
            setcookie("email", $_POST["email"], time() + 3600);
            setcookie("num_guess", 0, time() + 3600);
            $word = $this->loadQuestion();
            setcookie("word", $word, time() + 3600);
            header("Location: ?command=question");
            return;
        }

        include "templates/login.php";
    }

    // Load a question from the API
    private function loadQuestion() {
        $triviaData = file_get_contents('https://www.cs.virginia.edu/~jh2jf/courses/cs4640/spring2022/wordlist.txt');
        // Return the question
        $words = explode("\n",$triviaData);
        return $words[array_rand($words)];
    }

    // Display the question template (and handle question logic)
    public function question() {
        // set user information for the page from the cookie
        $user = [
            "name" => $_COOKIE["name"],
            "email" => $_COOKIE["email"],
            "num_guess" => $_COOKIE["num_guess"],
            "word" => $_COOKIE["word"]
        ];

        // if the user submitted an answer, check it
        if (isset($_POST["answer"])) {
            // Update the num_guess
            $user["num_guess"] += 1;  
            // Update the cookie: won't be available until next page load (stored on client)
            setcookie("num_guess", $_COOKIE["num_guess"] + 1, time() + 3600);
            
            if ($_POST["answer"] == $_COOKIE["word"]) {
                $answer = $_POST["answer"];
                // user answered correctly -- perhaps we should also be better about how we
                // verify their answers, perhaps use strtolower() to compare lower case only.
                $message = "<div class='alert alert-success'><b>$answer</b> was correct!</div>"; 
                // Update the cookie: won't be available until next page load (stored on client)
                $word = $this->loadQuestion();
                setcookie("word", $word, time() + 3600);
            } else { 
                $message = "<div class='alert alert-danger'>{$_POST["answer"]} was incorrect! The answer was: {$_COOKIE["word"]}</div>";
            }
            setcookie("correct", "", time() - 3600);
        }

        // update the question information in cookies

        include("templates/question.php");
    }
}