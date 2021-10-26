<?php

namespace App\Repository;

use App\Entity\Nv3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nv3|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nv3|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nv3[]    findAll()
 * @method Nv3[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Nv3Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nv3::class);
    }

    // /**
    //  * @return Nv3[] Returns an array of Nv3 objects
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
    public function findOneBySomeField($value): ?Nv3
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
