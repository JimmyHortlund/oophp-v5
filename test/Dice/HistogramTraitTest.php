<?php

namespace Jiho\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class HistogramTraitTest extends TestCase
{

    public function testCurrentHistogramIsArray()
    {
        $gameHandler = new GameHandler();

        $this->assertIsArray($gameHandler->getCurrentHistogram());
    }

    public function testHistogramPlayerOneStartValue()
    {
        $gameHandler = new GameHandler();
        $res = $gameHandler->gethistogramPlayerOne();
        $exp = ["", "", "", "", "", ""];
        $this->assertEquals($res, $exp);
    }

    public function testHistogramPlayerTwoStartValue()
    {
        $gameHandler = new GameHandler();
        $res = $gameHandler->gethistogramPlayerTwo();
        $exp = ["", "", "", "", "", ""];
        $this->assertEquals($res, $exp);
    }

    public function testCurrentHistogramIsEmpty()
    {
        $gameHandler = new GameHandler();
        $res = $gameHandler->getCurrentHistogram();
        $this->assertEmpty($res);
    }
}
