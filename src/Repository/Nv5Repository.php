<?php

namespace App\Repository;

use App\Entity\Nv5;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nv5|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nv5|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nv5[]    findAll()
 * @method Nv5[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Nv5Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nv5::class);
    }

    // /**
    //  * @return Nv5[] Returns an array of Nv5 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Nv5
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
