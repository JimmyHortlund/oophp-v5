<?php
/**
 * Guess my number, a class supporting the game through GET, POST and SESSION.
 */
class Guess
{
    /**
     * @var int $number   The current secret number.
     * @var int $tries    Number of tries a guess has been made.
     */
    private $number;
    private $tries;
  
    
    /**
     * Constructor to initiate the object with current game settings,
     * if available. Randomize the current number if no value is sent in.
     *
     * @param int $number The current secret number, default -1 to initiate
     *                    the number from start.
     * @param int $tries  Number of tries a guess has been made,
     *                    default 6.
     */
    
    public function __construct(int $number = -1, int $tries = 6)
    { 
        $this->number = $number;
        $this->tries = $tries;  
    }

    /**
     * Randomize the secret number between 1 and 100 to initiate a new game.
     *
     * @return void
     */
    
    public function random()
    { 
        $this->number = rand(1, 100);
    }
    
    public function doGuessButton() 
    {
        if ($_SESSION["tries"] < 2) {
            return "";
        } else {
            return "<input type='submit' name='doGuess' value='Make a guess'>";
        }  
    }

    /**
     * Get number of tries left.
     *
     * @return int as number of tries made.
     */
    
    public function tries()
    { 
        return $this->tries;
    }
    
    public function destroy() 
    {
        echo "destroying session";
        // Unset all of the session variables.
        $_SESSION = [];

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }       

        // Finally, destroy the session.
        session_destroy();
        header("Refresh:0");
    }


    /**
     * Get the secret number.
     *
     * @return int as the secret number.
     */
    
    public function number()
    {
        $this->random();
        return $this->number;
    }

   
    /**
     * Make a guess, decrease remaining guesses and return a string stating
     * if the guess was correct, too low or to high or if no guesses remains.
     * 
     * @throws GuessException when guessed number is out of bounds.
     *
     * @return string to show the status of the guess made.
     */
    
    public function makeGuess($number, $guess)
    {   
        if ($guess < 1 || $guess > 100) {
            throw new PersonAgeException("Only numbers between 1 and 100 is allowed ");
        }
        --$_SESSION["tries"];
        if ($number == $guess) {
            echo "CORRECT!";
            header("Location: src/winner.php");
        } else if ($number < $guess) {
            if ($_SESSION["tries"] < 1) {
                echo "TOO HIGH! and you lost the game!";
            } else {
                echo "TOO HIGH";
            }
        } else {
            if ($_SESSION["tries"] < 1) {
                echo "TOO LOW! and you lost the game!";
            } else {
                echo "TOO LOW!!!";
            } 
        }
    }   
}
