<?php

namespace App\Repository;

use App\Entity\Tacces;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tacces|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tacces|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tacces[]    findAll()
 * @method Tacces[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaccesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tacces::class);
    }

    // /**
    //  * @return Tacces[] Returns an array of Tacces objects
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
    public function findOneBySomeField($value): ?Tacces
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
