<?php

namespace App\Repository;

use App\Entity\TdocumentVersion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TdocumentVersion|null find($id, $lockMode = null, $lockVersion = null)
 * @method TdocumentVersion|null findOneBy(array $criteria, array $orderBy = null)
 * @method TdocumentVersion[]    findAll()
 * @method TdocumentVersion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TdocumentVersionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TdocumentVersion::class);
    }

    // /**
    //  * @return TdocumentVersion[] Returns an array of TdocumentVersion objects
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
    public function findOneBySomeField($value): ?TdocumentVersion
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
