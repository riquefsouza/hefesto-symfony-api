<?php

namespace App\Service;

use App\Entity\AdmProfile;
use App\Repository\AdmProfileRepository;

class AdmProfileService
{
    /**
     * @var AdmProfileRepository
     */
    private $repository;

    public function __construct(AdmProfileRepository $repository) {
        $this->repository = $repository;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
            //$item->AdmProfileParent = $this->menuRepository->find($item->getIdMenuParent()); 
        }
    }

    public function setTransient(AdmProfile $item): void
    {
        //$item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        //$item->AdmProfileParent = $this->menuRepository->find($item->getIdMenuParent()); 
    }

}