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

    /**
     * @return AdmMenu[]
     */
    public function findMenuParentByIdProfiles(array $listaIdProfile){
       
        //return $this->createQueryBuilder()
        //->select($alias)
        //->from($this->_entityName, $alias);

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
