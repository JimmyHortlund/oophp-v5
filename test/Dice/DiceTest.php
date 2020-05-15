<?php

namespace Jiho\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceTest extends TestCase
{
    public function testCreateObjectNoArguments()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiho\Dice\Dice", $dice);

        $res = $dice->getDiceSides();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectOneArgument()
    {
        $dice = new Dice(4);
        $this->assertInstanceOf("\Jiho\Dice\Dice", $dice);

        $res = $dice->getDiceSides();
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    public function testRandomNumberIsInt()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiho\Dice\Dice", $dice);

        $dice->randomNumber();
        $res = $dice->getDiceRoll();

        $this->assertIsInt($res);
    }

    public function testGetRollReturnsInt()
    {
        $dice = new Dice();
        $this->assertInstanceOf("\Jiho\Dice\Dice", $dice);

        $res = $dice->getRoll();
        $this->assertIsInt($res);
    }
}
