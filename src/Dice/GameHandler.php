<?php
"use strict";

namespace Jiho\Dice;

class GameHandler implements HistogramInterface
{
    use HistogramTrait;
    private $currentSum;
    private $serie = [];

    /**
     * Inject the object to use as base for the histogram data.
     *
     * @param HistogramInterface $object The object holding the serie.
     *
     * @return void.
     */
    public function getHistogramSerie($serie)
    {
        $this->serie = $serie;
        $this->setHistogramSerie($this->serie ?? null);
    }

    /**
     * Checks if the dicerolls contains a ' 1 '
     * if yes, change player, set player sum to ' 0 '
     * if no, add the sum to playerSum
     */

    public function checkForOnes($diceRolls)
    {
        if (strpos($diceRolls, '1') !== false) {
            return true;
        }
    }

    // returns the player who is playing
    public function getPlayerTurn($player)
    {
        if ($player == "Player One") {
            return "Computer";
        } else {
            return "Player One";
        }
    }

    public function computerAI($playerTurn, $currentSum, $playerOneTotalSum, $playerTwoTotalSum)
    {
        if ($playerTurn == "Player One"  || $currentSum == "You rolled a '1' and lost this turns points") {
            return "";
        } else {
            if ($playerOneTotalSum > $playerTwoTotalSum && $currentSum < 12) {
                return "ROLL!!!";
            } else {
                return "SAVE!!!!";
            }
        }
    }

    //set and get player one sum for current session
    public function setCurrentSum($sum)
    {
        $this->currentSum = $sum;
    }
    public function getCurrentSum()
    {
        return $this->currentSum;
    }

    public function saveButton()
    {
        if ($_SESSION["saved"] == true) {
            return "";
        } else {
            return "<input type='submit' class='saveButton button' name='save' value='Save'>";
        }
    }


    //destroys session
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
    }
}
