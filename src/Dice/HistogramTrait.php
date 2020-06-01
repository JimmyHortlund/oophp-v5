<?php

namespace Jiho\Dice;

/**
 * A trait implementing HistogramInterface.
 */
trait HistogramTrait
{


    /**
     * @var array $serie  The numbers stored in sequence.
     */
    private $serie = [];
    private $resultArray;
    private $resultString;
    private $stars;
    private $currentHistogram = [];
    private $histogramPlayerOne = ["", "", "", "", "", ""];
    private $histogramPlayerTwo = ["", "", "", "", "", ""];


    public function getHistogramPlayerOne()
    {
        return $this->histogramPlayerOne;
    }

    public function getHistogramPlayerTwo()
    {
        return $this->histogramPlayerTwo;
    }
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function setHistogramSerie($serieString)
    {
        $this->resultString = $serieString;
        $this->resultArray = explode(', ', $serieString);
    }

    public function makeStars()
    {
        for ($i=0; $i < count($this->resultArray); $i++) {
            $this->stars .= "*";
        }
    }

    public function getCurrentHistogram()
    {
        return $this->currentHistogram;
    }

     /**
     * Return a string with a textual representation of the histogram.
     *
     * @return string representing the histogram.
     */
    public function setCurrentHistogram()
    {
        for ($i=0; $i < 6; $i++) {
            array_push($this->currentHistogram, substr($this->stars, 0, substr_count($this->resultString, ($i+1))));
        }
    }


    /**
     * Tar emot nuvarande kast i form av array med stjärnor
     * Tar emot
     */
    public function getPlayerOneHistogram($currentHistogram, $playerOneHistogram)
    {

        for ($i=0; $i < 6; $i++) {
            $this->histogramPlayerOne[$i] = $currentHistogram[$i] . $playerOneHistogram[$i];
        }

        return $this->histogramPlayerOne;
    }
}
