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
 * This class is an implementation of StaticChoice of init of playoff.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayoffFromStaticChoice extends StaticChoice implements StaticChoiceInterface
{
    /**
     * @var int
     */
    const EIGHTH_FINAL = 1;

    /**
     * @var int
     */
    const QUARTER_FINALS = 2;

    /**
     * @var int
     */
    const SEMIFINALS = 3;

    /**
     * @var int
     */
    const FINALS = 4;

    public static function choice()
    {
        return array_combine(['Octavos de final','cuartos de final','Semifinales','Finales'], self::values());
    }

    public function format()
    {
        return "%s";
    }

    public function values()
    {
        return [
            static::EIGHTH_FINAL,
            static::QUARTER_FINALS,
            static::SEMIFINALS,
            static::FINALS,
        ];
    }
}
