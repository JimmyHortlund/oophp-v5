<?php

namespace Jiho\Guess;

/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Init the game and redirect to play the game.
 */
$app->router->get("guess/init", function () use ($app) {
    // Init the session for the gamestart.
    $game = new Guess();

    /**
     * calls functions that returns number and tries
     * saves in SESSION
     * */
    $_SESSION["number"] = $game->number();
    $_SESSION["tries"] = $game->tries();

    return $app->response->redirect("guess/play");
});


/**
 * Play the game show game status.
 */
$app->router->get("guess/play", function () use ($app) {
    $title = "Play the game";

    //get current number and tries from the SESSION

    $tries = $_SESSION["tries"]?? null;
    $number = $_SESSION["number"]?? null;
    $res = $_SESSION["res"] ?? null;
    $guess = $_SESSION["guess"] ?? null;
    $doCheat = $_SESSION["doCheat"] ?? null;
    $doInit = $_SESSION["doInit"] ?? null;


    $_SESSION["res"] = null;
    $_SESSION["guess"] = null;
    $_SESSION["doCheat"] = null;
    $_SESSION["doInit"] = null;

    $data = [
        "number" => $number,
        "res" => $res,
        "guess" => $guess ?? null,
        "tries" => $tries,
        "doGuess" => $doGuess ?? null,
        "doCheat" => $doCheat ?? null,
        "doInit" => $doInit ?? null,
    ];

    $app->page->add("guess/play", $data);

    // var_dumps SESSION POST and Get
    $app->page->add("guess/debug");


    return $app->page->render([
        "title" => $title,
    ]);
});

$app->router->post("guess/play", function () use ($app) {

    $guess = $_POST["guess"] ?? null;
    $doGuess = $_POST["doGuess"]?? null;
    $doCheat = $_POST["doCheat"] ?? null;
    $doInit = $_POST["doInit"] ?? null;

    //get current number and tries from the SESSION
    $number = $_SESSION["number"]?? null;
    $tries = $_SESSION["tries"]?? null;

    if ($doInit) {
        $game = new Guess($number, $tries);
        $_SESSION["doInit"] = $game->destroy();
        return $app->response->redirect("guess/init");
    }

    if ($doCheat) {
        $_SESSION["doCheat"] = $number;
    }

    if ($doGuess) {
        $game = new Guess($number, $tries);
        $_SESSION["tries"] = $game->tries();
        $res = $game->makeGuess($number, $guess);
        $_SESSION["res"] = $res;
        $_SESSION["guess"] = $guess;
    }

    return $app->response->redirect("guess/play");
});
