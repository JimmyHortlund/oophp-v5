<h1>Guess the number</h1>

<p>Guess a number between 1 and 100</p>

<form method="post">
    <input type="text" name="guess">
    <?= $game->doGuessButton(); ?>
    <input type="submit" name="doInit" value="Start from beginning">
    <input type="submit" name="doCheat" value="Cheat">
</form>

<?php if ($doCheat) : ?>
    <p>The secret number is: <?= $_SESSION["number"] ?></p>
<?php endif; ?>

<?php if ($doGuess) : ?>
    <p> <?= $guess; ?> is ... <?php $game->makeGuess($_SESSION["number"], $guess)  ?></p>
<?php endif; ?>

<p>You have <?= $_SESSION["tries"] ?> tries left.</p>

<?php if ($doInit) : ?>
    <p> <?php $game->destroy(); ?></p>
<?php endif; ?>
