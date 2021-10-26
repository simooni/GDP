<?php

namespace App\Repository;

use App\Entity\Nv2;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nv2|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nv2|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nv2[]    findAll()
 * @method Nv2[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Nv2Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nv2::class);
    }

    // /**
    //  * @return Nv2[] Returns an array of Nv2 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nv2
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
