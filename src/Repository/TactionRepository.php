<?php

namespace App\Repository;

use App\Entity\Taction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Taction|null find($id, $lockMode = null, $lockVersion = null)
 * @method Taction|null findOneBy(array $criteria, array $orderBy = null)
 * @method Taction[]    findAll()
 * @method Taction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Taction::class);
    }

    // /**
    //  * @return Taction[] Returns an array of Taction objects
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
    public function findOneBySomeField($value): ?Taction
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function findByIntitule($intitule,$code)
    {
        return $this->createQueryBuilder('t')
            ->where('t.intitule LIKE :intituleAction')
            ->andWhere('t.code_nv LIKE :code_nvAction')
            ->setParameter('intituleAction', '%'.$intitule.'%')
            ->setParameter('code_nvAction', $code)
            ->getQuery()
            ->getResult()
        ;
        
    }
    public function findByType($type,$code)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.Taction', 'ta')
            ->where('ta.type LIKE :typeAction')
            ->andWhere('t.code_nv LIKE :code_nvAction')
            ->setParameter('typeAction', '%'.$type.'%')
            ->setParameter('code_nvAction', $code)
            ->getQuery()
            ->getResult()
        ;
        
    }
    public function findByIntituleType($intitule, $type, $code)
    {
        return $this->createQueryBuilder('t')
            ->innerJoin('t.Taction', 'ta')
            ->where('t.intitule LIKE :intituleAction')
            ->andWhere('ta.type LIKE :typeAction')
            ->andWhere('t.code_nv LIKE :code_nvAction')
            ->setParameter('intituleAction', '%'.$intitule.'%')
            ->setParameter('typeAction', '%'.$type.'%')
            ->setParameter('code_nvAction', $code)
            ->getQuery()
            ->getResult()
        ;
        
    }
}
