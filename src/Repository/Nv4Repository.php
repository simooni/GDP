<?php

namespace App\Repository;

use App\Entity\Nv4;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Nv4|null find($id, $lockMode = null, $lockVersion = null)
 * @method Nv4|null findOneBy(array $criteria, array $orderBy = null)
 * @method Nv4[]    findAll()
 * @method Nv4[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Nv4Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Nv4::class);
    }

    // /**
    //  * @return Nv4[] Returns an array of Nv4 objects
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
    public function findOneBySomeField($value): ?Nv4
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
