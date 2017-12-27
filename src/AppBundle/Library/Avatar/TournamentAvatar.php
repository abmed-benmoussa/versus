<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Library\Avatar;

/**
 * This is an implementation of avatar for Tournaments
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class TournamentAvatar extends Avatar implements AvatarInterface
{
    public function getFolderName()
    {
        return "tournament";
    }
}
