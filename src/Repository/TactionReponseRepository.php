<?php

namespace App\Repository;

use App\Entity\TactionReponse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TactionReponse|null find($id, $lockMode = null, $lockVersion = null)
 * @method TactionReponse|null findOneBy(array $criteria, array $orderBy = null)
 * @method TactionReponse[]    findAll()
 * @method TactionReponse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TactionReponseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TactionReponse::class);
    }

    // /**
    //  * @return TactionReponse[] Returns an array of TactionReponse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TactionReponse
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
