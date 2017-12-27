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
 * This class is an interface to work with StaticChoice.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
interface StaticChoiceInterface
{
    public function values();
    public function format();
}
