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
 * This class is an implementation of StaticChoice of matches per day.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class MatchesPerDayStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const ONE_PER_DAY = 1;

    /**
     * @var int
     */
    const TWO_PER_DAY = 2;

    /**
     * @var int
     */
    const THREE_PER_DAY = 3;

    /**
     * @var int
     */
    const FOUR_PER_DAY = 4;

    /**
     * @var int
     */
    const FIVE_PER_DAY = 5;

    /**
     * @var int
     */
    const SIX_PER_DAY = 6;

    /**
     * @var int
     */
    const SEVEN_PER_DAY = 7;

    /**
     * @var int
     */
    const EIGHT_PER_DAY = 8;

    /**
     * @var int
     */
    const NINE_PER_DAY = 9;

    /**
     * @var int
     */
    const TEN_PER_DAY = 10;

    /**
     * @var int
     */
    const ELEVEN_PER_DAY = 11;

    /**
     * @var int
     */
    const TWELVE_PER_DAY = 12;

    public function format()
    {
        return "%d por día";
    }

    public function values()
    {
        return [
            static::ONE_PER_DAY,
            static::TWO_PER_DAY,
            static::THREE_PER_DAY,
            static::FOUR_PER_DAY,
            static::FIVE_PER_DAY,
            static::SIX_PER_DAY,
            static::SEVEN_PER_DAY,
            static::EIGHT_PER_DAY,
            static::NINE_PER_DAY,
            static::TEN_PER_DAY,
            static::ELEVEN_PER_DAY,
            static::TWELVE_PER_DAY,
        ];
    }
}
