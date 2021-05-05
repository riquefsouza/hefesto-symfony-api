<?php

namespace App\Repository;

use App\Entity\AdmUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmUser[]    findAll()
 * @method AdmUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmUser::class);
    }

    /**
     * @return AdmUser|null
     */
    public function findOneUserByLogin(string $login): AdmUser|null {
        return $this->findOneBy(array('login' => $login));
    }

    // /**
    //  * @return AdmUser[] Returns an array of AdmUser objects
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
    public function findOneBySomeField($value): ?AdmUser
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
