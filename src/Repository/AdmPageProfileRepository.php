<?php

namespace App\Repository;

use App\Entity\AdmPageProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmPageProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmPageProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmPageProfile[]    findAll()
 * @method AdmPageProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmPageProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmPageProfile::class);
    }

    /**
     * @return AdmPageProfile[] Returns an array of AdmPageProfile objects
     */
    public function findByIdPage(int $admPageId){
        return $this->findBy(array('idPage' => $admPageId));
    }

    /**
     * @return AdmPageProfile[] Returns an array of AdmPageProfile objects
     */
    public function findByIdProfile(int $admProfileId){
        return $this->findBy(array('idProfile' => $admProfileId));
    }

    // /**
    //  * @return AdmPageProfile[] Returns an array of AdmPageProfile objects
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
    public function findOneBySomeField($value): ?AdmPageProfile
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
