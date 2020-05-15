<?php
"use strict";

namespace Jiho\Dice;

// One dice with x-amount of sides rolled randomly
class Dice extends DiceHand
{
    /**
     * @var int $diceRoll consisting a random int
     * @var int $diceSides consisting the sides of the dice
     */

    private $diceRoll;
    private $diceSides;

    /**
     * Constructor to initiate the dice with a number of sides.
     * @param int number of sides to the dice to create, deafault set to six
     */
    public function __construct($diceSides = 6) 
    {
        $this->diceSides = $diceSides;
    }

    public function getDiceSides() 
    {
        return $this->diceSides;
    }
    /**
     * Creates a random number and saves in @var $diceRoll.
     * @return void.
     */
    public function randomNumber() 
    {
        $randNumber = rand(1, $this->diceSides);
        $this->diceRoll = $randNumber;   
    }

    public function getDiceRoll() 
    {
        return $this->diceRoll;
    }

    /**
     * Uses function randomNumber to create a random number
     * and returns the number
     * @return int.
     */
    public function getRoll() 
    {
        $this->randomNumber();
        return $this->diceRoll;
    }
}
