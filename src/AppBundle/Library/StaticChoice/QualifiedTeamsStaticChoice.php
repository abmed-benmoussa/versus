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
 * This class is an implementation of StaticChoice of number of teams qualified.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class QualifiedTeamsStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const ONE_TEAMS = 1;

    /**
     * @var int
     */
    const TWO_TEAMS = 2;

    /**
     * @var int
     */
    const THREE_TEAMS = 3;

    /**
     * @var int
     */
    const FOUR_TEAMS = 4;

    /**
     * @var int
     */
    const FIVE_TEAMS = 5;

    /**
     * @var int
     */
    const SIX_TEAMS = 6;

    /**
     * @var int
     */
    const SEVEN_TEAMS = 7;

    /**
     * @var int
     */
    const EIGHT_TEAMS = 8;

    /**
     * @var int
     */
    const NINE_TEAMS = 9;

    /**
     * @var int
     */
    const TEN_TEAMS = 10;

    /**
     * @var int
     */
    const ELEVEN_TEAMS = 11;

    /**
     * @var int
     */
    const TWELVE_TEAMS = 12;

    /**
     * @var int
     */
    const THIRTEEN_TEAMS = 13;

    /**
     * @var int
     */
    const FOURTEEN_TEAMS = 14;

    /**
     * @var int
     */
    const FIFTEEN_TEAMS = 15;

    /**
     * @var int
     */
    const SIXTEEN_TEAMS = 16;

    /**
     * @var int
     */
    const SEVENTEEN_TEAMS = 17;

    /**
     * @var int
     */
    const EIGHTEEN_TEAMS = 18;

    /**
     * @var int
     */
    const NINETEEN_TEAMS = 19;

    /**
     * @var int
     */
    const TWENTY_TEAMS = 20;

    /**
     * @var int
     */
    const TWENTY__ONE_TEAMS = 21;

    /**
     * @var int
     */
    const TWENTY_TWO_TEAMS = 22;

    /**
     * @var int
     */
    const TWENTY_THREE_TEAMS = 23;

    /**
     * @var int
     */
    const TWENTY_FOUR_TEAMS = 24;

    /**
     * @var int
     */
    const TWENTY_FIVE_TEAMS = 25;

    /**
     * @var int
     */
    const TWENTY_SIX_TEAMS = 26;

    /**
     * @var int
     */
    const TWENTY_SEVEN_TEAMS = 27;

    /**
     * @var int
     */
    const TWENTY_EIGHT_TEAMS = 28;

    /**
     * @var int
     */
    const TWENTY_NINE_TEAMS = 29;

    /**
     * @var int
     */
    const THIRTY_TEAMS = 30;

    /**
     * @var int
     */
    const THIRTY_ONE_TEAMS = 31;

    /**
     * @var int
     */
    const THIRTY_TWO_TEAMS = 32;

    /**
     * @var int
     */
    const THIRTY_THREE_TEAMS = 33;

    /**
     * @var int
     */
    const THIRTY_FOUR_TEAMS = 34;

    /**
     * @var int
     */
    const THIRTY_FIVE_TEAMS = 35;

    /**
     * @var int
     */
    const THIRTY_SIX_TEAMS = 36;

    /**
     * @var int
     */
    const THIRTY_SEVEN_TEAMS = 37;

    /**
     * @var int
     */
    const THIRTY_EIGHT_TEAMS = 38;

    /**
     * @var int
     */
    const THIRTY_NINE_TEAMS = 39;

    /**
     * @var int
     */
    const FORTY_TEAMS = 40;

    /**
     * @var int
     */
    const FORTY_ONE_TEAMS = 41;

    /**
     * @var int
     */
    const FORTY_TWO_TEAMS = 42;

    /**
     * @var int
     */
    const FORTY_THREE_TEAMS = 43;

    /**
     * @var int
     */
    const FORTY_FOUR_TEAMS = 44;

    /**
     * @var int
     */
    const FORTY_FIVE_TEAMS = 45;

    /**
     * @var int
     */
    const FORTY_SIX_TEAMS = 46;

    /**
     * @var int
     */
    const FORTY_SEVEN_TEAMS = 47;

    /**
     * @var int
     */
    const FORTY_EIGHT_TEAMS = 48;

    public function format()
    {
        return "%d Equipo(s)";
    }

    public function values()
    {
        return [
            static::ONE_TEAMS,
            static::TWO_TEAMS,
            static::THREE_TEAMS,
            static::FOUR_TEAMS,
            static::FIVE_TEAMS,
            static::SIX_TEAMS,
            static::SEVEN_TEAMS,
            static::EIGHT_TEAMS,
            static::NINE_TEAMS,
            static::TEN_TEAMS,
            static::ELEVEN_TEAMS,
            static::TWELVE_TEAMS,
            static::THIRTEEN_TEAMS,
            static::FOURTEEN_TEAMS,
            static::FIFTEEN_TEAMS,
            static::SIXTEEN_TEAMS,
            static::SEVENTEEN_TEAMS,
            static::EIGHTEEN_TEAMS,
            static::NINETEEN_TEAMS,
            static::TWENTY_TEAMS,
            static::TWENTY__ONE_TEAMS,
            static::TWENTY_TWO_TEAMS,
            static::TWENTY_THREE_TEAMS,
            static::TWENTY_FOUR_TEAMS,
            static::TWENTY_FIVE_TEAMS,
            static::TWENTY_SIX_TEAMS,
            static::TWENTY_SEVEN_TEAMS,
            static::TWENTY_EIGHT_TEAMS,
            static::TWENTY_NINE_TEAMS,
            static::THIRTY_TEAMS,
            static::THIRTY_ONE_TEAMS,
            static::THIRTY_TWO_TEAMS,
            static::THIRTY_THREE_TEAMS,
            static::THIRTY_FOUR_TEAMS,
            static::THIRTY_FIVE_TEAMS,
            static::THIRTY_SIX_TEAMS,
            static::THIRTY_SEVEN_TEAMS,
            static::THIRTY_EIGHT_TEAMS,
            static::THIRTY_NINE_TEAMS,
            static::FORTY_TEAMS,
            static::FORTY_ONE_TEAMS,
            static::FORTY_TWO_TEAMS,
            static::FORTY_THREE_TEAMS,
            static::FORTY_FOUR_TEAMS,
            static::FORTY_FIVE_TEAMS,
            static::FORTY_SIX_TEAMS,
            static::FORTY_SEVEN_TEAMS,
            static::FORTY_EIGHT_TEAMS,
        ];
    }
}
