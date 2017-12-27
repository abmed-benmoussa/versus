<?php

namespace BackendBundle\Repository;

use BackendBundle\Entity\User;
use BackendBundle\Entity\Tournament;
/**
 * TorneosRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TournamentRepository extends \Doctrine\ORM\EntityRepository
{
    public function getByUserQuery(User $user)
    {
        return $this->createQueryBuilder('t')
            ->where('t.user = :user')
            ->orderBy('t.id', 'DESC')
            ->setParameter('user', $user)
            ->getQuery()
        ;
    }
}
