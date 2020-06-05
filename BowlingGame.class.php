<?php

require_once('ScoreBoard.class.php');

class BowlingGame
{
    private $scoreBoard;
    private $players;
    private $newPlayerNumber = 1;
    private $rounds = 10;
    private $maxPins = 10;

    public function __construct()
    {
        echo 'Welkom bij de BowlingGame' . PHP_EOL;
        echo 'Om te beginnen met bowlen moet je spelers toevoegen' . PHP_EOL;
        $this->askPlayerNames();
    }

    private function askPlayerNames()
    {
        echo 'Wat is de naam van de speler ' . $this->newPlayerNumber . '?' . PHP_EOL;
        $playerName = readline('');
        if (isset($playerName)) {
            $this->addPlayer($playerName);
            $this->newPlayerNumber++;
            echo 'wilt u nog een speler invoeren? (Ja/Nee)';
            $morePlayers = strtolower(
                readline('')
            );

            if ($morePlayers === 'ja') {
                $this->askPlayerNames();
            } else {
                $this->scoreBoard = new ScoreBoard($this->players);
                $this->playAllRounds();
            }
        } else {
            echo 'Ongeldige speler naam';
            $this->askPlayerNames();
        }
    }

    private function addPlayer($playerName)
    {
        $this->players[] = $playerName;
    }

    private function playAllRounds()
    {
    }

    private function playRound()
    {
    }

    private function throwBall($player, $maxPins = null)
    {

    }
}