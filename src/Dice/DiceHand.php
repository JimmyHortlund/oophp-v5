<?php
"use strict";

namespace Jiho\Dice;

/**
 * A dicehand, consisting of dices.
 */
class DiceHand
{
    /**
     * @var Dice $dices Array consisting of dices, object of Dice.
     * @var int $numOfDices amount of dices
     * @var string $output returns string with rolled dices
     * @var int $diceSides amount of sides of the dices
     * @var int  $values  Array consisting of last roll of the dices.
     * @var int $average Average number of all dices rolled
     */
    private $dices = [];
    private $numOfDices;
    private $output;
    private $sum;
    private $average;
    

    /**
     * Constructor to initiate the dicehand with a number of dices.
     *
     * @param int $numOfDices Number of dices to create, defaults to five.
     */
    public function __construct($numOfDices = 6) 
    {
        $this->numOfDices = $numOfDices;
    }

    /**
     * creates objects fom class Dice and saves in array @var dices
     * @param int number of dices
     * @return void.
     */
    public function addDice($diceSides) 
    {
        for ($i=0; $i < $this->numOfDices; $i++) { 
            $this->dices[] = new Dice($diceSides);
        } 
    }

    /**
     * calls method from class @var Dice via object @var int $dice
     * that creates a random roll.
     * Saves the random roll in @var string $output.
     * Also saves the sum of all rolls in @var int $sum
     * @return void.
     */
    public function getDice() 
    {
        for ($i=0; $i < $this->numOfDices; $i++) { 
            $this->output .= $this->dices[$i]->getRoll() . ", ";
        } 
    }

    /**
     * returns the string with all rolls
     * @return int $output
     */
    public function getOutput() 
    {
        return $this->output;
    }

    /**
     * returns the sum of all the dicerolls
     * @return int $sum as the sum
     */
    public function getSum() 
    {
        $sumArray = explode(",", $this->output);
        foreach ($sumArray as $value) {
            $this->sum += intval($value);
        }
        return $this->sum;
    }

    /**
     * returns the average of all the dicerolls
     * @return int $average as average sum
     */
    public function getAverage() 
    {
        return $this->average = $this->sum / $this->numOfDices;  
    }
}  
