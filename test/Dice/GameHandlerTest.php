<?php

namespace Jiho\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class GameHandlerTest extends TestCase
{
    public function testCheckForOnesReturnsCorrectStringIfOne()
    {
        $gameHandler = new GameHandler();
        $this->assertInstanceOf("\Jiho\Dice\GameHandler", $gameHandler);

        $res = $gameHandler->checkForOnes(1);
        $exp = true;

        $this->assertEquals($exp, $res);
    }

    public function testGetPlayerTurnReturnsRightPlayer()
    {
        $gameHandler = new GameHandler();
        $this->assertInstanceOf("\Jiho\Dice\GameHandler", $gameHandler);

        $res = $gameHandler->getPlayerTurn("Player One");
        $exp = "Computer";

        $this->assertEquals($exp, $res);

        $res = $gameHandler->getPlayerTurn("Computer");
        $exp = "Player One";

        $this->assertEquals($exp, $res);
    }

    public function testSetAndGetCurrentSum()
    {
        $gameHandler = new GameHandler();
        $this->assertInstanceOf("\Jiho\Dice\GameHandler", $gameHandler);

        $gameHandler->setCurrentSum(5);
        $res = $gameHandler->getCurrentSum();
        $exp = 5;

        $this->assertEquals($exp, $res);
    }
}
