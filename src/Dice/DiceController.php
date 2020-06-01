<?php

namespace Jiho\Dice;

use Anax\Commons\AppInjectableInterface;
use Anax\Commons\AppInjectableTrait;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $app if implementing the interface
 * AppInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class DiceController implements AppInjectableInterface
{
    use AppInjectableTrait;



    /**
     * @var string $db a sample member variable that gets initialised
     */
    // private $db = "not active";



    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    // public function initialize() : void
    // {
    //     // Use to initialise member variables.
    //     $this->db = "active";

    //     // Use $this->app to access the framework services.
    // }



    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function debugAction() : string
    {
        // Deal with the action and return a response.
        return "Debug my game";
    }
        /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function indexAction() : string
    {
        // Deal with the action and return a response.
        return "Index";
    }

    /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function initAction() : object
    {
        $session = $this->app->session;
        $response = $this->app->response;
        $session->set("currentHistogram", ["", "", "", "", "", ""]);
        $session->set("playerOneHistogram", ["", "", "", "", "", ""]);
        $session->set("playerTwoHistogram", ["", "", "", "", "", ""]);
        $session->set("playerTurn", "Player One");
        $session->set("saved", true);


        return $response->redirect("dice1/playDice");
    }

        /**
     * This is the index method action, it handles:
     * ANY METHOD mountpoint
     * ANY METHOD mountpoint/
     * ANY METHOD mountpoint/index
     *
     * @return string
     */
    public function playDiceActionGet() : object
    {

        $title = "Play Dice 100";
        $session = $this->app->session;
        $page = $this->app->page;

        $playerOneHistogram = $session->get("playerOneHistogram");
        $playerTwoHistogram = $session->get("playerTwoHistogram");
        $output = $session->get("output");
        $currentHistogram = $session->get("currentHistogram");

        $playerTurn = $session->get("playerTurn");
        $currentSum = $session->get("currentSum");
        $playerOneTotalSum = $session->get("playerOneTotalSum");
        $playerTwoTotalSum = $session->get("playerTwoTotalSum");
        $computerAI = $session->get("computerAI");

        $data = [
            "output" => $output,
            "playerTurn" => $playerTurn,
            "currentSum" => $currentSum,
            "playerOneTotalSum" => $playerOneTotalSum,
            "playerTwoTotalSum" => $playerTwoTotalSum,
            "currentHistogram" => $currentHistogram,
            "playerOneHistogram" => $playerOneHistogram,
            "playerTwoHistogram" => $playerTwoHistogram,
            "computerAI" => $computerAI
        ];

        $this->app->page->add("dice1/playDice", $data);
        //$app->page->add("dice/debug");

        return $page->render([
            "title" => $title
        ]);
    }


    public function playDiceActionPost()
    {
        $session = $this->app->session;
        $request = $this->app->request;
        $response = $this->app->response;


        $destroy = $request->getPost("destroy");
        $rollAgain = $request->getPost("rollAgain");
        $save = $request->getPost("save");
        if ($destroy) {
            $gameHandler = new GameHandler();
            $gameHandler->destroy();
            return $this->app->response->redirect("dice1/init");
        }

        if ($rollAgain) {
            $gameHandler = new GameHandler();

            $session->set("saved", false);
            $numberOfDices = 3;
            if ($request->getPost("numberOfDices") == "") {
                $numberOfDices = 3;
            } else {
                $numberOfDices = $request->getPost("numberOfDices");
            }
            $diceSides = 6;
            $hand = new DiceHand($numberOfDices);


            $hand->addDice($diceSides);
            $hand->getDice();
            $output = substr($hand->getOutput(), 0, -2);
            $gameHandler->setCurrentSum($hand->getSum());


            $session->set("output", $output);
            $output = $session->get("output");

            $gameHandler->getHistogramSerie($output);
            $gameHandler->makeStars();
            $gameHandler->setCurrentHistogram();
            $session->set("currentHistogram", $gameHandler->getCurrentHistogram());
            $currentHistogram = $session->get("currentHistogram");
            $playerOneHistogram = $session->get("playerOneHistogram");
            $playerTwoHistogram = $session->get("playerTwoHistogram");

            if ($session->get("playerTurn") == "Player One") {
                $session->set("playerOneHistogram", $gameHandler->getPlayerOneHistogram($currentHistogram, $playerOneHistogram));
            } else {
                $session->set("playerTwoHistogram", $gameHandler->getPlayerOneHistogram($currentHistogram, $playerTwoHistogram));
            }

            if ($gameHandler->checkForOnes($output) === true) {
                $session->set("saved", true);
                $session->set("playerTurn", $gameHandler->getPlayerTurn($session->get("playerTurn")));
                $session->set("currentSum", $gameHandler->getCurrentSum() + $session->get("currentSum"));
                $session->set("currentSum", "You rolled a '1' and lost this turns points");
            } else {
                $session->set("currentSum", $gameHandler->getCurrentSum() + $session->get("currentSum"));
            }

            $session->set("computerAI", $gameHandler->computerAI(
                $session->get("playerTurn"),
                $session->get("currentSum"),
                $session->get("playerOneTotalSum"),
                $session->get("playerTwoTotalSum")
            ));
        }

        if ($save) {
            if ($session->get("playerTurn") == "Player One") {
                $session->set("playerOneTotalSum", $session->get("currentSum") + $session->get("playerOneTotalSum"));
                $session->set("playerTurn", "Computer");
                $session->set("currentSum", "");
                $session->set("output", "");
                $session->set("saved", true);
            } else {
                $session->set("playerTwoTotalSum", $session->get("currentSum") + $session->get("playerTwoTotalSum"));
                $session->set("playerTurn", "Player One");
                $session->set("currentSum", "");
                $session->set("output", "");
                $session->set("saved", true);
                $session->set("computerAI", "");
            }
        }
        return $response->redirect("dice1/playDice");
    }
}
