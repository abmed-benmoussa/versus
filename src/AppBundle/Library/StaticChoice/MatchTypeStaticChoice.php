<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\StaticChoice;

/**
 * This class is an implementation of StaticChoice of type of match.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class MatchTypeStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const UNIQUE_MATCH = 1;

    /**
     * @var int
     */
    const ONE_WAY_MATCHES = 2;

    /**
     * @var int
     */
    const ROUND_TRIP = 3;

    public static function choice()
    {
        return array_combine(['Partido único','Partidos de ida','Ida y Vuelta'], self::values());
    }

    public static function choiceLess($less)
    {
        $choice = static::choice();
        if (($key = array_search($less, $choice)) !== false) {
            unset($choice[$key]);
        }
        return $choice;
    }

    public function format()
    {
        return "%s";
    }

    public function values()
    {
        return [
            static::UNIQUE_MATCH,
            static::ONE_WAY_MATCHES,
            static::ROUND_TRIP,
        ];
    }
}
