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
        for ($i = 0; $i < $this->rounds; $i++) {
            $displayRound = $i + 1;
            echo '---------------------------------------' . PHP_EOL;
            echo 'Ronde ' . $displayRound . PHP_EOL;
            echo '---------------------------------------' . PHP_EOL;
            $this->playRound();
        }
        echo '---------------------------------------' . PHP_EOL;
        echo 'Einde' . PHP_EOL;
        echo '---------------------------------------' . PHP_EOL;
        $this->scoreBoard->displayEndScores();
    }

    private function playRound()
    {
        foreach ($this->players as $player) {
            $score = [
                0 => 0,
                1 => 0
            ];
            $pinsTrowedFirstRound = $this->throwBall($player);
            $score[0] = $pinsTrowedFirstRound;
            if ($pinsTrowedFirstRound != $this->maxPins) {
                $pinsToTrow = $this->maxPins - $pinsTrowedFirstRound;
                echo "{$player} zit te denken hoeveel hij nog moet gooien om te winnen ..." . PHP_EOL;
                sleep(5);
                echo "{$player} heeft bedacht dat hij nog {$pinsToTrow} kegels om moet gooien om te winnen" . PHP_EOL;
                echo PHP_EOL;
                $pinsTrowedSecondRound = $this->throwBall($player, $pinsToTrow);
                $score[1] = $pinsTrowedSecondRound;
                if ($score[0] + $score[1] === $this->maxPins) {
                    echo "{$player} is redelijk blij dat hij een spar heeft gegooid";
                } else {
                    echo "{$player} is verdrietig dat hij geen spar of strike heeft gegooid";
                }
            } else {
                echo "{$player} is blij hij heeft een strike gegooid!";
            }
            $this->scoreBoard->calculatePlayerScore($player, $score);
            echo PHP_EOL;
        }
    }

    private function throwBall($player, $maxPins = null)
    {
        if ($maxPins === null) {
            $maxPins = $this->maxPins;
        }
        echo "{$player} loopt naar de ballen bak..." . PHP_EOL;
        sleep(5);
        echo "{$player} pakt de bal..." . PHP_EOL;
        sleep(2);
        echo "{$player} loopt met de bal naar de baan..." . PHP_EOL;
        sleep(5);
        echo "{$player} gooit de bal..." . PHP_EOL;
        sleep(10);
        $pinsTrowed = rand(0, $maxPins);
        echo "{$player} kijkt naar het scoreBoard..." . PHP_EOL;
        sleep(2);
        echo "{$player} heeft {$pinsTrowed} gegooid..." . PHP_EOL;
        sleep(1);
        return $pinsTrowed;
    }
}