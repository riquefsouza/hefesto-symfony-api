<?php

namespace App\Repository;

use App\Entity\AdmPage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmPage|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmPage|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmPage[]    findAll()
 * @method AdmPage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmPageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmPage::class);
    }

    // /**
    //  * @return AdmPage[] Returns an array of AdmPage objects
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
    public function findOneBySomeField($value): ?AdmPage
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
