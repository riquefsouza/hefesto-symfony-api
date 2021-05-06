<?php

namespace App\Repository;

use App\Entity\AdmProfile;
use App\Entity\AdmMenu;
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

    /**
     * @return AdmMenu[]
     */
	public function findMenuParentByIdProfiles(array $listaIdProfile){
        $query = $this->createNamedQuery("AdmProfile.findMenuParentByIdProfiles");
        $query->setParameter(1, $listaIdProfile);
        $lista = $query->getResult();
        return $lista;
    }
    /**
     * @return AdmMenu[]
     */
	public function findMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        $query = $this->createNamedQuery("AdmProfile.findMenuByIdProfiles");
        $query->setParameter(1, $listaIdProfile);
        $query->setParameter(2, $admMenuId);
        $lista = $query->getResult();
        return $lista;
    }
    /**
     * @return AdmMenu[]
     */
	public function findAdminMenuParentByIdProfiles(array $listaIdProfile){
        $query = $this->createNamedQuery("AdmProfile.findAdminMenuParentByIdProfiles");
        $query->setParameter(1, $listaIdProfile);
        $lista = $query->getResult();
        return $lista;
    }
    /**
     * @return AdmMenu[]
     */
	public function findAdminMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        $query = $this->createNamedQuery("AdmProfile.findAdminMenuByIdProfiles");
        $query->setParameter(1, $listaIdProfile);
        $query->setParameter(2, $admMenuId);
        $lista = $query->getResult();
        return $lista;
    }

}
