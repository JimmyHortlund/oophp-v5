<?php

include(__DIR__ . "/src/autoload.php");
include(__DIR__ . "/src/config.php");


$game = new Guess();
$tries = $game->tries();
$number = $game->number();
$guess = $_POST["guess"] ?? null;
$doCheat = $_POST["doCheat"] ?? null;
$doGuess = $_POST["doGuess"] ?? null;
$doInit = $_POST["doInit"] ?? null;
$doReturn = $_POST["doReturn"] ?? null;

if (!isset($_SESSION["number"])) {
    $_SESSION["number"] = $number; 
}

if (!isset($_SESSION["tries"])) {
    $_SESSION["tries"] = $tries; 
}

include(__DIR__ . "/view/guess_the_number.php");
