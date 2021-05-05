<?php

namespace App\Repository;

use App\Entity\AdmParameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmParameter|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmParameter|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmParameter[]    findAll()
 * @method AdmParameter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmParameterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmParameter::class);
    }

    // /**
    //  * @return AdmParameter[] Returns an array of AdmParameter objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AdmParameter
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
