<?php

namespace Jiho\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class DiceHandTest extends TestCase
{
    public function testCreateObjectNoArguments()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Jiho\Dice\DiceHand", $dice);
    }

    public function testGetSumIsInt()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Jiho\Dice\DiceHand", $dice);

        $res = $dice->getSum();

        $this->assertIsInt($res);
    }

    public function testGetOutputIsNull()
    {
        $dice = new DiceHand();
        $this->assertInstanceOf("\Jiho\Dice\DiceHand", $dice);

        $res = $dice->getOutput();

        $this->assertNull($res);
    }
}
