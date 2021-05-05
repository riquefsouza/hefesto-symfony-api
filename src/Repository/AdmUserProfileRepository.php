<?php

namespace App\Repository;

use App\Entity\AdmUserProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmUserProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmUserProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmUserProfile[]    findAll()
 * @method AdmUserProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmUserProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmUserProfile::class);
    }

    // /**
    //  * @return AdmUserProfile[] Returns an array of AdmUserProfile objects
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
    public function findOneBySomeField($value): ?AdmUserProfile
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
