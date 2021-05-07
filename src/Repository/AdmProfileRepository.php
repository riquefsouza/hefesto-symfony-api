<?php

namespace App\Repository;

use App\Entity\AdmProfile;
use App\Entity\AdmMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use Doctrine\DBAL\Types\Types;
use Doctrine\SqlFormatter\NullHighlighter;

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
/*
    private function mapAdmMenu(ResultSetMapping $rsm){
        $rsm->addEntityResult('App\Entity\AdmMenu', 'mnu');
        $rsm->addFieldResult('mnu', 'id', 'mnu_seq');
        $rsm->addFieldResult('mnu', 'name', 'mnu_description');
        $rsm->addFieldResult('mnu', 'idMenuParent', 'mnu_parent_seq');
        $rsm->addFieldResult('mnu', 'idPage', 'mnu_pag_seq');
        $rsm->addFieldResult('mnu', 'order', 'mnu_order');
    }

    **
     * @return AdmMenu[]
     *
	public function findMenuParentByIdProfiles(array $listaIdProfile){
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_menu mnu 
                where mnu.mnu_seq in (
                    select admmenus4_.mnu_parent_seq 
                    from adm_profile admprofile1_ 
                    inner join adm_page_profile admpages2_ on admprofile1_.prf_seq=admpages2_.pgl_prf_seq 
                    inner join adm_page admpage3_ on admpages2_.pgl_pag_seq=admpage3_.pag_seq 
                    inner join adm_menu admmenus4_ on admpage3_.pag_seq=admmenus4_.mnu_pag_seq 
                    where (admprofile1_.prf_seq in (1,2)) and admmenus4_.mnu_seq > 9
                ) 
                order by mnu.mnu_order, mnu.mnu_seq";

        $rsm = new ResultSetMapping;
        $this->mapAdmMenu($rsm);

        $query = $this->_em->createNativeQuery($sql, $rsm);
        //$query->setParameter(1, $listaIdProfile, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        //$query->setParameter(1, array(1,2), \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);

        $users = $query->getResult();
    }

    **
     * @return AdmMenu[]
     *
    public function findMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_profile admprofile0_ 
                inner join adm_page_profile admpages1_ on admprofile0_.prf_seq=admpages1_.pgl_prf_seq 
                inner join adm_page admpage2_ on admpages1_.pgl_pag_seq=admpage2_.pag_seq 
                inner join adm_menu mnu on admpage2_.pag_seq=mnu.mnu_pag_seq 
                where admprofile0_.prf_seq in (1,2) and mnu.mnu_seq > 9 and mnu.mnu_parent_seq=?1
                order by mnu.mnu_seq, mnu.mnu_order";

        $rsm = new ResultSetMapping;
        $this->mapAdmMenu($rsm);

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $admMenuId, Types::INTEGER);
        //$query->setParameter(1, $listaIdProfile, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        //$query->setParameter(1, array(1,2), \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        
        
        $users = $query->getResult();        
    }

    **
     * @return AdmMenu[]
     *
    public function findAdminMenuParentByIdProfiles(array|null $listaIdProfile){
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_menu mnu 
                where mnu.mnu_seq in (
                    select admmenus4_.mnu_parent_seq 
                    from adm_profile admprofile1_ 
                    inner join adm_page_profile admpages2_ on admprofile1_.prf_seq=admpages2_.pgl_prf_seq 
                    inner join adm_page admpage3_ on admpages2_.pgl_pag_seq=admpage3_.pag_seq 
                    inner join adm_menu admmenus4_ on admpage3_.pag_seq=admmenus4_.mnu_pag_seq 
                    where admprofile1_.prf_seq in (1,2) and admmenus4_.mnu_seq <= 9) 
                order by mnu.mnu_order, mnu.mnu_seq";

        $rsm = new ResultSetMapping;
        $this->mapAdmMenu($rsm);

        $query = $this->_em->createNativeQuery($sql, $rsm);
        //$query->setParameter(1, $listaIdProfile, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        //$query->setParameter(1, array(1,2), \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        
        $users = $query->getResult();
    }

    **
     * @return AdmMenu[]
     *
    public function findAdminMenuByIdProfiles(array $listaIdProfile, int $admMenuId) {
        $sql = "select distinct mnu.mnu_seq, mnu.mnu_description, mnu.mnu_parent_seq, mnu.mnu_pag_seq, mnu.mnu_order
                from adm_profile admprofile0_ 
                inner join adm_page_profile admpages1_ on admprofile0_.prf_seq=admpages1_.pgl_prf_seq 
                inner join adm_page admpage2_ on admpages1_.pgl_pag_seq=admpage2_.pag_seq 
                inner join adm_menu mnu on admpage2_.pag_seq=mnu.mnu_pag_seq 
                where admprofile0_.prf_seq in (1,2) and mnu.mnu_seq <= 9 and mnu.mnu_parent_seq=?1
                order by mnu.mnu_seq, mnu.mnu_order";

        $rsm = new ResultSetMapping;
        $this->mapAdmMenu($rsm);

        $query = $this->_em->createNativeQuery($sql, $rsm);
        $query->setParameter(1, $admMenuId, Types::INTEGER);
        //$query->setParameter(1, $listaIdProfile, \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
        //$query->setParameter(1, array(1,2), \Doctrine\DBAL\Connection::PARAM_INT_ARRAY);
                
        $users = $query->getResult();
    }
    */
}
