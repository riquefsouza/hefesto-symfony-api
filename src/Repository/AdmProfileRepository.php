<?php

namespace App\Repository;

use App\Entity\AdmProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmProfile[]    findAll()
 * @method AdmProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmProfile::class);
    }

    // /**
    //  * @return AdmProfile[] Returns an array of AdmProfile objects
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
    public function findOneBySomeField($value): ?AdmProfile
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
