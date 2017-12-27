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

use FOS\UserBundle\Doctrine\UserManager as FOSUserManager;
use Doctrine\ORM\EntityManager;
use BackendBundle\Entity\Team;
use BackendBundle\Entity\User;
use AppBundle\Library\Item\PlayerItem;

/**
 * This class help to admin the users.
 * @author Jerry Anselmi <jerry.anselmi@gmail.com>
 */
class UserManager
{
    use PlayerUserManager;

    /**
     * @var \FOS\UserBundle\Doctrine\UserManager
     */
    protected $userManager;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    public function __construct(
        FOSUserManager $userManager,
        EntityManager $entityManager
    ) {
        $this->userManager = $userManager;
        $this->manager = $entityManager;
    }

    public function createAdministrator(Administrator &$entity)
    {
        $user = $this->userManager->createUser();
        $user
            ->setFirstName($entity->getFirstName())
            ->setLastName($entity->getLastName())
            ->setUsername($entity->getUsername())
            ->setEmail($entity->getEmail())
            ->setPlainPassword($entity->getPassword())
            ->setEnabled(true)
            ->setSuperAdmin(false)
            ->setRoles(['ROLE_ADMIN'])
        ;
        $this->userManager->updateUser($user);
        $entity->setUser($user);
    }

    public function updateAdministrator(Administrator &$entity)
    {
        $user = $entity->getUser();
        $user
            ->setFirstName($entity->getFirstName())
            ->setLastName($entity->getLastName())
            ->setUsername($entity->getUsername())
            ->setEmail($entity->getEmail())
        ;
        $this->userManager->updateUser($user);
        $entity->setUser($user);
    }

    public function enabledUser(&$entity)
    {
        $user = $entity->getUser()->setEnabled(true);
        $this->userManager->updateUser($user);
        $entity->setUser($user)->setStatus(1);
    }

    public function disableUser(&$entity)
    {
        $user = $entity->getUser()->setEnabled(false);
        $this->userManager->updateUser($user);
        $entity->setUser($user)->setStatus(2);
    }

    private function generatePassword()
    {
        return bin2hex(openssl_random_pseudo_bytes(4));
    }
}
