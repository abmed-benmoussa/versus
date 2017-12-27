<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\Item;

/**
 * This class is an implamentation of player item for bulkload.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class PlayerItem extends Item
{
    protected $document;
    protected $firstName;
    protected $lastName;
    protected $birthday;
    protected $email;
    protected $phoneNumber;
    protected $positions;
    protected $shirtNumber;
    protected $isCaptain;

    protected function parseBirthday($value)
    {
        if (is_a($value, 'DateTime')) {
            return $value;
        }

        $date = null;
        try {
            $date = new \DateTime(vsprintf(
                '%d-%d-%d',
                array_reverse(explode("/", $value)))
            );

        } catch (\Exception $e) {

        }

        return $date;
    }

    protected function parsePositions($value)
    {
        return is_string($value) ? explode(' ', $value) : $value;
    }

    protected function parseIsCaptain($value)
    {
        return is_string($value) ? in_array(strtolower(trim($value)), ['si', 'yes']) : $value;
    }
}
