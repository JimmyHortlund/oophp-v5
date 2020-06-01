<?php
"use strict";

namespace Jiho\Dice;

$gameHandler = new GameHandler();
$saveButton = $gameHandler->saveButton();


?>
<h2>" <?= $playerTurn ?> "  <?= $computerAI ?> </h2>
<h3>Player One Score: | <?= $playerOneTotalSum ?> | -- VS -- Computer Score: | <?= $playerTwoTotalSum ?> | </h3>
<p>The rolls are: <?= $output ?></p>
<p>Sum: <?= $currentSum ?> </p>
<form method="post">
    <input type="submit" class="rollAgainButton button" name="rollAgain" value="Roll">
    <input type="submit" class="destroyButton button" name="destroy" value="Restart Game">
    <input type="number" class= "button" name="numberOfDices" min="1" max="10" size="4">
    <?= $saveButton ?>
</form>

<p>Increase or decrese the number of dices of your current throw <br>
    ( 1 - 10 ) by clicking on the arrows, Default number is 3.
  
</p>

<div class="histogram_container">
    <p>Computer Histogram:</p>
    <ol>
        <li class="badNumber"> <?= $playerTwoHistogram[0] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerTwoHistogram[1] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerTwoHistogram[2] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerTwoHistogram[3] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerTwoHistogram[4] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerTwoHistogram[5] ?? null ?> </li>
    </ol>
</div>

<div class="histogram_container">
    <p>Player One Histogram:</p>
    <ol>
        <li class="badNumber"> <?= $playerOneHistogram[0] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerOneHistogram[1] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerOneHistogram[2] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerOneHistogram[3] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerOneHistogram[4] ?? null ?> </li>
        <li class="goodNumber"> <?= $playerOneHistogram[5] ?? null ?> </li>
    </ol>
</div>

<div class="histogram_container">
    <p>Current Histogram:</p>
    <ol>
        <li class="badNumber"> <?= $currentHistogram[0] ?? null ?> </li>
        <li class="goodNumber"> <?= $currentHistogram[1] ?? null ?> </li>
        <li class="goodNumber"> <?= $currentHistogram[2] ?? null ?> </li>
        <li class="goodNumber"> <?= $currentHistogram[3] ?? null ?> </li>
        <li class="goodNumber"> <?= $currentHistogram[4] ?? null ?> </li>
        <li class="goodNumber"> <?= $currentHistogram[5] ?? null ?> </li>
    </ol>
</div>
