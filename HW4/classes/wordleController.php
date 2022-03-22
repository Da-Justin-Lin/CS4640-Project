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
        setcookie("guesses", "", time() - 3600);
    }
    

    // Display the login page (and handle login logic)
    public function login() {
        if (isset($_POST["email"]) && !empty($_POST["email"])) { /// validate the email coming in
            setcookie("name", $_POST["name"], time() + 3600);
            setcookie("email", $_POST["email"], time() + 3600);
            setcookie("guesses", 0, time() + 3600);
            header("Location: ?command=question");
            return;
        }

        include "templates/login.php";
    }

    // Load a question from the API
    private function loadQuestion() {
        $triviaData = json_decode(
            file_get_contents("http://www.cs.virginia.edu/~jh2jf/courses/cs4640/spring2022/wordlist.txt")
            , true);
        // Return the question
        return $triviaData["results"][0];
    }

    // Display the question template (and handle question logic)
    public function question() {
        // set user information for the page from the cookie
        $user = [
            "name" => $_COOKIE["name"],
            "email" => $_COOKIE["email"],
            "guesses" => $_COOKIE["guesses"]
        ];

        // load the question
        $question = $this->loadQuestion();
        if ($question == null) {
            die("No questions available");
        }

        // if the user submitted an answer, check it
        if (isset($_POST["answer"])) {
            // Update the guesses
            $user["guesses"] += 1;  
            // Update the cookie: won't be available until next page load (stored on client)
            setcookie("guesses", $_COOKIE["guesses"] + 1, time() + 3600);
            $answer = $_POST["answer"];
            
            if ($_COOKIE["answer"] == $question) {
                // user answered correctly -- perhaps we should also be better about how we
                // verify their answers, perhaps use strtolower() to compare lower case only.
                $message = "<div class='alert alert-success'><b>$answer</b> was correct!</div>";
            } else { 
                $message = "<div class='alert alert-danger'><b>$answer</b> was incorrect! The answer was: {$_COOKIE["answer"]}</div>";
            }
            setcookie("correct", "", time() - 3600);
        }

        // update the question information in cookies
        setcookie("answer", $question["correct_answer"], time() + 3600);

        include("templates/question.php");
    }
}