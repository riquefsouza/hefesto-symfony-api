<?php

namespace App\Repository;

use App\Entity\AdmMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method AdmMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdmMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdmMenu[]    findAll()
 * @method AdmMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdmMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AdmMenu::class);
    }

    /**
     * @return AdmMenu[]
     */
    public function findByIdMenuParent(int $idMenuParent){
        return $this->findBy(array('idMenuParent' => $idMenuParent));
    }

    // /**
    //  * @return AdmMenu[] Returns an array of AdmMenu objects
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
    public function findOneBySomeField($value): ?AdmMenu
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
