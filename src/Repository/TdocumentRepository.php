<?php

namespace App\Repository;

use App\Entity\Tdocument;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Tdocument|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tdocument|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tdocument[]    findAll()
 * @method Tdocument[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TdocumentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tdocument::class);
    }

    // /**
    //  * @return Tdocument[] Returns an array of Tdocument objects
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
    public function findOneBySomeField($value): ?Tdocument
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findByIntitule($intitule, $code)
    {
        return $this->createQueryBuilder('d')
                ->where('d.intitule LIKE :intituleDocument')
                ->andWhere('d.code_nv LIKE :codeDocument')
                ->setParameter('intituleDocument', '%'.$intitule.'%')
                ->setParameter('codeDocument', $code)
                ->getQuery()
                ->getResult();
    }

  
    public function findByType($type, $code)
    {
        return $this->createQueryBuilder('d')
                ->where('d.typeDocument LIKE :typeDocument')
                ->andWhere('d.code_nv LIKE :codeDocument')
                ->setParameter('typeDocument', '%'.$type.'%')
                ->setParameter('codeDocument', $code)
                ->getQuery()
                ->getResult();
        
    }
    public function findByIntituleType($intitule, $type, $code)
    {
        return $this->createQueryBuilder('d')
                ->where('d.intitule LIKE :intituleDocument')
                ->andWhere('d.typeDocument LIKE :typeDocument')
                ->andWhere('d.code_nv LIKE :codeDocument')
                ->setParameter('intituleDocument', '%'.$intitule.'%')
                ->setParameter('typeDocument', '%'.$type.'%')
                ->setParameter('codeDocument', $code)
                ->getQuery()
                ->getResult();
    }

    // SELECT td.id , td.intitule FROM tdocument td INNER JOIN taction ta ON td.id = ta.dossier_id GROUP BY td.id
    public function getDocumentHadAction($code)
    {
        return $this->createQueryBuilder('d')
                ->innerJoin("d.tactions", "a")
                ->andWhere('d.code_nv LIKE :codeDocument')
                ->andWhere('d.suspondu <> 1')
                ->setParameter('codeDocument', $code)
                ->groupBy("d")
                ->getQuery()
                ->getResult();
    }
}
