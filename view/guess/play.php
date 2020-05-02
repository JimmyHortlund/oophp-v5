<?php

namespace Jiho\Guess;

/**
 * Render content within an article.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$game = new Guess();

?>

<h1>Guess the number</h1>

<p>Guess a number between 1 and 100</p>
<form method="post">
    <input type="text" name="guess">
    <?= $game->doGuessButton(); ?>
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doCheat) : ?>
    <p>The secret number is: <?= $number ?></p>
<?php endif; ?>

<?php if ($res) : ?>
    <p> <?= '" ' . $guess . ' "' ?> <?= $res  ?></p>
<?php endif; ?>

<p>You have <?= $tries ?> tries left.</p>


