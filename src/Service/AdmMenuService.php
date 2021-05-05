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

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmMenu $item): void
    {
        if ($item->getIdPage()!=null){
            $item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        }
        if ($item->getIdMenuParent()!=null){
            $item->AdmMenuParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
    }

}