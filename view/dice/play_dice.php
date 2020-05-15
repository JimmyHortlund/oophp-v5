<?php
"use strict";

namespace Jiho\Dice;

$gameHandler = new GameHandler();
$saveButton = $gameHandler->saveButton();

?>
<h2>" <?= $playerTurn ?> "</h2>
<h3>Player One Score: | <?= $playerOneTotalSum ?> | -- VS -- Computer Score: | <?= $playerTwoTotalSum ?> | </h3>
<p>The rolls are: <?= $output ?></p>
<p>Sum: <?= $currentSum ?><?= $checkForOnes ?></p>
<form method="post">
    <input type="submit" name="rollAgain" value="Roll">
    <?= $saveButton ?>
    <input type="submit" name="destroy" value="destroy">
    <input type="number" name="numberOfDices" min="1" max="10" size="4">
</form>

<p>Increase or decrese the number of dices of your current throw <br>
    ( 1 - 10 ) by clicking on the arrows, Default number is 3.
</p>






