<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\Fixture;

/**
 * This generate the features of teams in a group.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class GroupFixture
{
    private $originlas;
    private $controlIndex;
    private $controlIsHome;
    private $visitIndex;
    private $homeTeams;
    private $visitTeams;
    private $journeys;
    private $journalGames;
    private $fixtures;
    private $fixturesByJournal;

    public function __construct(array $teams, $oneWay = true)
    {
        shuffle($teams);
        $this->originlas = $teams;
        $this->controlIndex = array_rand($teams);
        $this->controlIsHome = false;
        $this->visitIndex = 0;
        array_splice($teams, $this->controlIndex, 1);
        $this->homeTeams = $teams;
        $this->visitTeams = array_reverse($teams);
        $this->journeys = count($teams);
        $this->journalGames = count($this->originlas)/2;
        $this->fixtures = [];
        $this->process($oneWay);
    }

    public function getFixtures()
    {
        return $this->fixtures;
    }

    public function getFixturesByJournal()
    {
        return $this->fixturesByJournal;
    }

    private function process($oneWay)
    {
        for ($i=0; $i < $this->journalGames; $i++) {
            for ($y=0; $y < $this->journeys; $y++) {
                $game = [$this->homeTeams[$y]];
                if ((($i*$this->journeys)+$y) % $this->journalGames == 0) {
                    $game[1] = $this->originlas[$this->controlIndex];
                    if ($this->controlIsHome) {
                        $game = array_reverse($game);
                    }
                    $this->controlIsHome = !$this->controlIsHome;
                } else {
                    $game[1] = $this->visitTeams[$this->visitIndex];
                    $this->visitIndex++;
                    if ($this->visitIndex >= $this->journeys) {
                        $this->visitIndex = 0;
                    }
                }
                $this->fixtures[] = $game;
            }
        }

        if (!$oneWay) {
            foreach (array_map('array_reverse', $this->fixtures) as $value) {
                $this->fixtures[] = $value;
            }
        }

        $this->fixturesByJournal = array_chunk($this->fixtures, $this->journalGames);
    }
}
