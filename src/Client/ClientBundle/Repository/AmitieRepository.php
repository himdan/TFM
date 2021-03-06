<?php

namespace Client\ClientBundle\Repository;

/**
 * AmitieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AmitieRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByCommun(){
        $req = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.toClient like :premium')
            ->orderBy('p.id')
            ->setParameter('premium', 'active');
        return $req->getQuery()->getResult();
    }

    public function findByTous($userId){
        $req = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.toClient  = :tous')
            ->orWhere('p.fromClient  = :tous')
            ->having('p.acceptAmitie like :accept')
            ->orderBy('p.id')
            ->setParameter('tous', $userId)
            ->setParameter('accept', '1');
        return $req->getQuery()->getResult();
    }

    public function findByTag($userId,$profile){
        $req = $this->createQueryBuilder('p')

            ->select('p')
            ->join('p.toClient','t')
            ->where('p.toClient  = :tous')
            ->orWhere('p.fromClient  = :tous')
            ->andWhere('t.nomClient like :tag')
            ->having('p.acceptAmitie like :accept')

            ->orderBy('p.id')
            ->setParameter('tous', $userId)
            ->setParameter('tag', $profile)
            ->setParameter('accept', '1');
        return $req->getQuery()->getResult();
    }

    public function checkFindByTous($userId){
        $req = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.toClient  = :tous')
            ->orWhere('p.fromClient  = :tous')
            ->orderBy('p.id')
            ->setParameter('tous', $userId);
        return $req->getQuery()->getSingleResult();
    }

    public function checkExisteAmi($iduser){
        $req = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.toClient  = :tous')
            ->orWhere('p.fromClient  = :tous')
            ->orderBy('p.id')
            ->setParameter('tous', $iduser);
        return $req->getQuery()->getResult();
    }

    public function findByRecent($userId){
        $req = $this->createQueryBuilder('p')
            ->select('p')
            ->where('p.toClient  = :tous')
            ->orWhere('p.fromClient  = :tous')
            ->having('p.acceptAmitie like :accept')
            ->orderBy('p.dateAmitie','DESC')
            ->setParameter('tous', $userId)
            ->setParameter('accept', '1');
        return $req->getQuery()->getResult();
    }

    public function findByEnvoye($userId){
        $req = $this->createQueryBuilder('p')
            ->select('p')

            ->orWhere('p.fromClient  = :tous')
            ->having('p.acceptAmitie like :accept')
            ->orderBy('p.dateAmitie','DESC')
            ->setParameter('tous', $userId)
            ->setParameter('accept', '0');
        return $req->getQuery()->getResult();
    }

    public function findByRecu($userId){
        $req = $this->createQueryBuilder('p')
            ->select('p')

            ->orWhere('p.toClient  = :tous')
            ->having('p.acceptAmitie like :accept')
            ->orderBy('p.dateAmitie','DESC')
            ->setParameter('tous', $userId)
            ->setParameter('accept', '0');
        return $req->getQuery()->getResult();
    }

    public function getNbAmis($user) {

        return $this->createQueryBuilder('p')


            ->select('COUNT(p)')
            ->where('p.fromClient = :id')
            ->andWhere('p.acceptAmitie like :accept')
            ->setParameter('id', $user)
            ->setParameter('accept', '1')
            ->getQuery()

            ->getSingleScalarResult();

    }


}
