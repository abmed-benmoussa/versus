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
 * This class is a base of static choices.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
abstract class StaticChoice
{
    public static function choice()
    {
        $choice = [];
        foreach (static::values() as $value) {
            $choice[sprintf(static::format(), $value)] = $value;
        }
        return $choice;
    }

    public static function textToValue($text)
    {
        return array_key_exists($text, $this->choice()) ? $this->choice()[$text] : null;
    }

    public static function valueToText($value)
    {
        return array_search($value, $this->choice());
    }
}
