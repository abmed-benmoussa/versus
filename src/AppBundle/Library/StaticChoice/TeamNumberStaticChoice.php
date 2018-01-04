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
 * This class is an implementation of StaticChoice of number of teams.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TeamNumberStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const FOUR_TEAMS = 4;

    /**
     * @var int
     */
    const SIX_TEAMS = 6;

    /**
     * @var int
     */
    const EIGHT_TEAMS = 8;

    /**
     * @var int
     */
    const TEN_TEAMS = 10;

    /**
     * @var int
     */
    const TWELVE_TEAMS = 12;

    /**
     * @var int
     */
    const FOURTEEN_TEAMS = 14;

    /**
     * @var int
     */
    const SIXTEEN_TEAMS = 16;

    /**
     * @var int
     */
    const EIGHTEEN_TEAMS = 18;

    /**
     * @var int
     */
    const TWENTY_TEAMS = 20;

    /**
     * @var int
     */
    const TWENTY_TWO_TEAMS = 22;

    /**
     * @var int
     */
    const TWENTY_FOUR_TEAMS = 24;

    /**
     * @var int
     */
    const THIRTY_TWO_TEAMS = 32;

    /**
     * @var int
     */
    const THIRTY_SIX_TEAMS = 36;

    /**
     * @var int
     */
    const FORTY_EIGHT_TEAMS = 48;

    public function format()
    {
        return "%d equipos";
    }

    public function values()
    {
        return [
            static::FOUR_TEAMS,
            static::SIX_TEAMS,
            static::EIGHT_TEAMS,
            static::TEN_TEAMS,
            static::TWELVE_TEAMS,
            static::FOURTEEN_TEAMS,
            static::SIXTEEN_TEAMS,
            static::EIGHTEEN_TEAMS,
            static::TWENTY_TEAMS,
            static::TWENTY_TWO_TEAMS,
            static::TWENTY_FOUR_TEAMS,
            static::THIRTY_TWO_TEAMS,
            static::THIRTY_SIX_TEAMS,
            static::FORTY_EIGHT_TEAMS,
        ];
    }
}
