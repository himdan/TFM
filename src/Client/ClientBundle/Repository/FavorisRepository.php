<?php

namespace Client\ClientBundle\Repository;

/**
 * FavorisRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FavorisRepository extends \Doctrine\ORM\EntityRepository
{
    public function findFavorisByUser($userId) {

        return $this->createQueryBuilder('p')

            ->select('COUNT(p)')
            ->where('p.client  =:user')
            ->setParameter('user', $userId)
            ->getQuery()

            ->getSingleScalarResult();

    }
}
