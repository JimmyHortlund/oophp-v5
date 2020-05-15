<?php

namespace Jiho\Dice;

/**
 * Init the game and redirect to play the game.
 */
$app->router->get("dice/init", function () use ($app) {
    
    $_SESSION["playerTurn"] = "Player One";
    $_SESSION["checkForOnes"] = "";
    $_SESSION["saved"] = true;
    
    // $gameHandler->destroy();
    return $app->response->redirect("dice/play_dice");
});

/**
 * Play the game show game status.
 */
$app->router->get("dice/play_dice", function () use ($app) {
    $title = "Play Dice 100";

    
    $output = $_SESSION["output"]?? null;
    $playerTurn = $_SESSION["playerTurn"]?? null;
    $currentSum = $_SESSION["currentSum"] ?? null;
    $playerOneTotalSum = $_SESSION["playerOneTotalSum"] ?? null;
    $playerTwoTotalSum = $_SESSION["playerTwoTotalSum"] ?? null;
    $checkForOnes = $_SESSION["checkForOnes"] ?? null;

    $data = [
        "output" => $output,
        "playerTurn" => $playerTurn,
        "currentSum" => $currentSum,
        "playerOneTotalSum" => $playerOneTotalSum,
        "playerTwoTotalSum" => $playerTwoTotalSum,
        "checkForOnes" => $checkForOnes
    ];

    $app->page->add("dice/play_dice", $data);
    //$app->page->add("dice/debug");

    return $app->page->render([
        "title" => $title
    ]);
});

$app->router->post("dice/play_dice", function () use ($app) {
    $destroy = $_POST["destroy"] ?? null;
    $rollAgain = $_POST["rollAgain"] ?? null;
    $save = $_POST["save"] ?? null;
    if ($destroy) {
        $gameHandler = new GameHandler();
        $gameHandler->destroy();
        return $app->response->redirect("dice/init");
    }

    if ($rollAgain) {
        $_SESSION["saved"] = false;
        $numberOfDices = 3;
        if ($_POST["numberOfDices"] == "") {
            $numberOfDices = 3;
        } else {
            $numberOfDices = $_POST["numberOfDices"];
        }
        $diceSides = 6;
        $hand = new DiceHand($numberOfDices);
        $gameHandler = new GameHandler();

        $hand->addDice($diceSides);
        $hand->getDice();
        $output = substr($hand->getOutput(), 0, -2);
        $gameHandler->setCurrentSum($hand->getSum());

        if ($_SESSION["checkForOnes"] = $gameHandler->checkForOnes($output)) {
            $_SESSION["saved"] = true;
            $_SESSION["playerTurn"] = $gameHandler->getPlayerTurn($_SESSION["playerTurn"]);
            $_SESSION["currentSum"] = "";
        } else {
                $_SESSION["currentSum"] += $gameHandler->getCurrentSum();
        }
        $_SESSION["output"] = $output;
    }

    if ($save) {
        if ($_SESSION["playerTurn"] == "Player One") {
            $_SESSION["playerOneTotalSum"] += $_SESSION["currentSum"];
            $_SESSION["playerTurn"] = "Computer";
            $_SESSION["currentSum"] = "";
            $_SESSION["output"] = "";
            $_SESSION["saved"] = true;
        } else {
            $_SESSION["playerTwoTotalSum"] += $_SESSION["currentSum"];
            $_SESSION["playerTurn"] = "Player One";
            $_SESSION["currentSum"] = "";
            $_SESSION["output"] = "";
            $_SESSION["saved"] = true;
        }
    }
    
    return $app->response->redirect("dice/play_dice");
});
