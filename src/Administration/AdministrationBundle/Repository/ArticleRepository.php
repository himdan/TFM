<?php

namespace Administration\AdministrationBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends EntityRepository
{
    public function getNb() {

        return $this->createQueryBuilder('p')

            ->select('COUNT(p)')

            ->getQuery()

            ->getSingleScalarResult();

    }


}
