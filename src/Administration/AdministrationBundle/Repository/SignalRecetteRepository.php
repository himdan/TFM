<?php

namespace Administration\AdministrationBundle\Repository;

/**
 * SignalRecetteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SignalRecetteRepository extends \Doctrine\ORM\EntityRepository
{

    public function getNbNotificationAdmin() {

        return $this->createQueryBuilder('p')


            ->select('COUNT(p)')

            ->getQuery()

            ->getSingleScalarResult();

    }

    public function getNbNotificationUser($user) {

        return $this->createQueryBuilder('p')

            ->join('p.recette','f')->select('f')
            ->where('f.auteur =:id')
            ->select('COUNT(p)')
            ->setParameter('id', $user)
            ->getQuery()

            ->getSingleScalarResult();

    }

    public function getNbAll() {

        return $this->createQueryBuilder('p')


            ->select('COUNT(p)')

            ->getQuery()

            ->getSingleScalarResult();

    }

    public function getNbAdmin() {

        return $this->createQueryBuilder('p')


            ->select('COUNT(p)')

            ->getQuery()

            ->getSingleScalarResult();

    }

    public function getNb($user) {

        return $this->createQueryBuilder('p')

            ->join('p.recette','f')->select('f')
            ->where('f.auteur =:id')
            ->select('COUNT(p)')
            ->setParameter('id', $user)
            ->getQuery()

            ->getSingleScalarResult();

    }

    public function findByUser($id){
        $req = $this->createQueryBuilder('p')

            ->join('p.recette','f')->select('f')
            ->where('f.auteur =:id')
            ->select('p')
            ->orderBy('p.dateSignalRecette','ASC')

            ->setParameter('id', $id);
        return $req->getQuery()->getResult();
    }
}
