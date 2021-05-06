<?php

namespace App\Service;

use App\Entity\AdmMenu;
use App\Repository\AdmMenuRepository;
use App\Repository\AdmPageRepository;

class AdmMenuService
{
    /**
     * @var AdmMenuRepository
     */
    private $menuRepository;
    
    /**
     * @var AdmPageRepository
     */
    private $pageRepository;

    public function __construct(AdmMenuRepository $menuRepository,
        AdmPageRepository $pageRepository) {
        $this->menuRepository = $menuRepository;
        $this->pageRepository = $pageRepository;
    }

    public function setTransientWithoutSubMenus(array $list): void
    {
        foreach ($list as $item) {
            $this->setTransientSubMenus($item, null);
        }
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item) {
            $this->setTransient($item);
        }
    }

    public function setTransientSubMenus(AdmMenu $item, array|null $subMenus): void
    {
        if ($item->getIdPage()!=null){
            $item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        }
        if ($item->getIdMenuParent()!=null){
            $item->AdmMenuParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
        if ($subMenus!=null) {
            $item->setAdmSubMenus($subMenus);
        }
    }

    public function setTransient(AdmMenu $item)
    {
        $this->setTransientSubMenus($item, $this->menuRepository->findByIdMenuParent($item->getId()));
    }

}