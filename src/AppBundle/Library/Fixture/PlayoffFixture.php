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
 * This generate the features of teams in a playoff round.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayoffFixture
{
    private $originlas;
    private $totalTeams;
    private $totalgames;
    private $fixtures;

    public function __construct(array $teams, $oneWay = true)
    {
        shuffle($teams);
        $this->originlas = $teams;
        $this->totalTeams = count($teams);
        $this->totalgames = $this->totalTeams/2;
        $this->fixtures = [];
        $this->process($oneWay);
    }

    public function getFixtures()
    {
        return $this->fixtures;
    }

    private function process($oneWay)
    {
        for ($i=0; $i < $this->totalgames; $i++) {
            $this->fixtures[] = [
                $this->originlas[$i],
                $this->originlas[$this->totalTeams -1 - $i]
            ];
        }

        if (!$oneWay) {
            foreach (array_map('array_reverse', $this->fixtures) as $value) {
                $this->fixtures[] = $value;
            }
        }
    }

}
