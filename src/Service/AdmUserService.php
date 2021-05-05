<?php

namespace App\Service;

use App\Entity\AdmUser;
use App\Repository\AdmUserRepository;

class AdmUserService
{
    /**
     * @var AdmUserRepository
     */
    private $repository;

    public function __construct(AdmUserRepository $repository) {
        $this->repository = $repository;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
            //$item->AdmUserParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
    }

    public function setTransient(AdmUser $item): void
    {
        //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        //$item->AdmUserParent = $this->menuRepository->find($item->getIdMenuParent()); 
    }

}