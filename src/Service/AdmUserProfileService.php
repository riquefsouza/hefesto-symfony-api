<?php

namespace App\Service;

use App\Entity\AdmUserProfile;
use App\Repository\AdmUserProfileRepository;

class AdmUserProfileService
{
    /**
     * @var AdmUserProfileRepository
     */
    private $repository;

    public function __construct(AdmUserProfileRepository $repository) {
        $this->repository = $repository;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
            //$item->AdmUserProfileParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
    }

    public function setTransient(AdmUserProfile $item): void
    {
        //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        //$item->AdmUserProfileParent = $this->menuRepository->find($item->getIdMenuParent()); 
    }

}