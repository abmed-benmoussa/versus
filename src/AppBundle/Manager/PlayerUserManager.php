<?php
/*
 * This file is part of the AppBundle package.
 *
 *  (c) Juan Urquiza <juanitourquiza@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */
namespace AppBundle\Manager;

use BackendBundle\Entity\Team;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Player;
use AppBundle\Library\Item\PlayerItem;

/**
 * This class help to admin the users.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
trait PlayerUserManager
{
    public function createOrUpdatePlayer(Team $team, PlayerItem $playerItem, array $positions)
    {
        if ($isNew = !$user = $this->userManager->findUserByEmail($playerItem->email)) {
            $user = $this->userManager->createUser();
        }

        $user
            ->setFirstName($playerItem->firstName)
            ->setLastName($playerItem->lastName)
            ->setUsername($playerItem->email)
            ->setEmail($playerItem->email)
            ->setPhoneNumber($playerItem->phoneNumber)
            ->setDocument($playerItem->document)
            ->setBirthday($playerItem->birthday)
            ->addRole('ROLE_PLAYER')
        ;

        if ($isNew) {
            $user
                //->setPlainPassword($this->generatePassword())
                ->setPlainPassword('123456')
                ->setEnabled(true)
                ->setSuperAdmin(false)
            ;
        }

        $this->setPlayerPositions($user, $playerItem, $positions);
        $this->setTeam($user, $team, $playerItem);

        $this->userManager->updateUser($user);
    }

    private function setPlayerPositions(User &$user, PlayerItem $playerItem, array $positions)
    {
        foreach ($user->getPlayerPositions() as $position) {
            if (!in_array($position->getAcronym(), $playerItem->positions)) {
                $user->removePlayerPosition($position);
            }
        }

        foreach ($positions as $position) {
            if (!$user->getPlayerPositions()->contains($position)) {
                $user->addPlayerPosition($position);
            }
        }
    }

    private function setTeam(User &$user, Team $team, PlayerItem $playerItem)
    {
        if (!$player = $user->getPlayer()) {
            $player = new Player();
        }

        $player
            ->setUser($user)
            ->setTeam($team)
            ->setIsCaptain($playerItem->isCaptain)
        ;

        if ($playerItem->shirtNumber) {
            $player->setShirtNumber($playerItem->shirtNumber);
        }
        $user->setPlayer($player);
    }
}
