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
            case "gameover":
                $this->gameover();
                break;
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
        setcookie("guess", "", time() + 3600);
        session_destroy();
        header("Location: ?command=login");
    }
    

    // Display the login page (and handle login logic)
    public function login() {
        session_start();
        if (isset($_POST["email"]) && !empty($_POST["email"])) { /// validate the email coming in
            setcookie("name", $_POST["name"], time() + 3600);
            setcookie("email", $_POST["email"], time() + 3600);
            setcookie("num_guess", 0, time() + 3600);
            $word = $this->loadQuestion();
            setcookie("word", " ", time() + 3600);
            setcookie("guess", $word, time() + 3600);
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
        $_SESSION = [
            "name" => $_COOKIE["name"],
            "email" => $_COOKIE["email"],
            "num_guess" => $_COOKIE["num_guess"],
            "word" => $_COOKIE["word"],
            "guess" => $_COOKIE["guess"],
        ];

        // if the user submitted an answer, check it
        if (isset($_POST["answer"])) {
            // Update the num_guess
            $_SESSION["num_guess"] += 1;  
            // Update the cookie: won't be available until next page load (stored on client)
            setcookie("num_guess", $_COOKIE["num_guess"] + 1, time() + 3600);
            
            if ($_POST["answer"] == $_COOKIE["word"]) {
                // $answer = $_POST["answer"];
                // // user answered correctly -- perhaps we should also be better about how we
                // // verify their answers, perhaps use strtolower() to compare lower case only.
                // $message = "<div class='alert alert-success'><b>$answer</b> was correct!</div>"; 
                // Update the cookie: won't be available until next page load (stored on client)
                //setcookie("word", $word, time() + 3600);
                header("Location: ?command=gameover");
            } else {     
                $guess = nl2br($_COOKIE["guess"] . "Guess: " . $_POST["answer"] . " is incorrect. " . 
                $this->charInTarget($_COOKIE["word"],$_POST["answer"]) . $this->charInCorrect($_COOKIE["word"],$_POST["answer"])
             . $this->lenComp($_COOKIE["word"],$_POST["answer"]) ."\n");
                setcookie("guess", $guess, time()+3600);
                $message = $guess;
            }
            setcookie("correct", "", time() - 3600);
        }else{
            $message = "Please take a guess";
        }

        // update the question information in cookies

        include("templates/question.php");
    }

    public function gameover(){
        $name = $_COOKIE["name"];
        $num = $_COOKIE["num_guess"];
        $right = $_COOKIE["word"];
        $word = $this->loadQuestion();
        setcookie("num_guess", 0, time() + 3600);
        setcookie("guess", " ", time() + 3600);
        setcookie("word", $word, time() + 3600);
        include("templates/gameover.php");
    }

    private function charInTarget($target, $guess) {
        $guess = strtolower($guess);
        $targetChar = array();
        $ans = 0;
        for ($x = 0; $x < strlen($target); $x++) {
            $targetChar[] = $target[$x];
        }
        for ($x = 0; $x < strlen($guess); $x++) {
            if(in_array($guess[$x], $targetChar)) {
                $index = array_search($guess[$x], $targetChar);
                unset($targetChar[$index]);
                $ans++;
            }
        }
        return $ans." of the characters are correct. ";
    }

    private function charInCorrect($target, $guess) {
        $guess = strtolower($guess);
        $targetChar = array();
        $guessChar = array();
        $ans = 0;
        for ($x = 0; $x < strlen($target); $x++) {
            $targetChar[] = $target[$x];
        }
        for ($x = 0; $x < strlen($guess); $x++) {
            $guessChar[] = $guess[$x];
        }
        $length = min(strlen($target),strlen($guess));
        for ($x = 0; $x < $length; $x++) {
            if($targetChar[$x] == $guessChar[$x]) {
                $ans++;
            }
        }
        return $ans." of the characters are in the correct place. ";
    }

    private function lenComp($target, $guess) {
        if(strlen($target) > strlen($guess)) {
            return "Your guess is too short.";
        }  
        else if (strlen($target) < strlen($guess)) {
            return "Your guess is too long.";
        }
        else {
            return "Your guess is the correct length.";
        }
    }
}