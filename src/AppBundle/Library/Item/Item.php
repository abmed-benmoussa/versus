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
 * This class is a base of item object for bulkload.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
abstract class Item
{
    /**
     * The constructor
     * @param  array  $item Sent message object.
     */
    public function __construct(array $item)
    {
        foreach (array_keys(get_object_vars($this)) as $key => $property) {
            $this->{$property} = $this->parseValue($property, $item[$key]);
        }
    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->{$name};
        }
    }

    private function parseValue($key, $value)
    {
        $method = sprintf("parse%s", ucwords($key));
        if (method_exists($this, $method)) {
            $value = $this->{$method}($value);
        }
        return $value;
    }
}
