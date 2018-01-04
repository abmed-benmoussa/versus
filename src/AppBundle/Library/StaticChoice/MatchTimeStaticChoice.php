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
 * This class is an implementation of StaticChoice of times of match.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class MatchTimeStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const TWO_TIMES_10_MINUTES = 10;

    /**
     * @var int
     */
    const TWO_TIMES_15_MINUTES = 15;

    /**
     * @var int
     */
    const TWO_TIMES_20_MINUTES = 20;

    /**
     * @var int
     */
    const TWO_TIMES_25_MINUTES = 25;

    /**
     * @var int
     */
    const TWO_TIMES_30_MINUTES = 30;

    /**
     * @var int
     */
    const TWO_TIMES_35_MINUTES = 35;

    /**
     * @var int
     */
    const TWO_TIMES_40_MINUTES = 40;

    /**
     * @var int
     */
    const TWO_TIMES_45_MINUTES = 45;

    public function format()
    {
        return "2T de %d minutos";
    }

    public function values()
    {
        return [
            static::TWO_TIMES_10_MINUTES,
            static::TWO_TIMES_15_MINUTES,
            static::TWO_TIMES_20_MINUTES,
            static::TWO_TIMES_25_MINUTES,
            static::TWO_TIMES_30_MINUTES,
            static::TWO_TIMES_35_MINUTES,
            static::TWO_TIMES_40_MINUTES,
            static::TWO_TIMES_45_MINUTES,
        ];
    }
}
