<?php

namespace App\Repository;

use App\Entity\Nv1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nv1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nv1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nv1[]    findAll()
 * @method Nv1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Nv1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nv1::class);
    }

    // /**
    //  * @return Nv1[] Returns an array of Nv1 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nv1
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
