<?php

namespace App\Repository;

use App\Entity\AdmParameterCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmParameterCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmParameterCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmParameterCategory[]    findAll()
 * @method AdmParameterCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmParameterCategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmParameterCategory::class);
    }

    // /**
    //  * @return AdmParameterCategory[] Returns an array of AdmParameterCategory objects
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
    public function findOneBySomeField($value): ?AdmParameterCategory
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
