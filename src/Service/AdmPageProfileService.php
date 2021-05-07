<?php

namespace App\Service;

use App\Entity\AdmPageProfile;
use App\Entity\AdmProfile;
use App\Repository\AdmPageRepository;
use App\Repository\AdmProfileRepository;
use App\Repository\AdmPageProfileRepository;

/**
 * @method AdmPageProfile[] findAll()
 * @method AdmProfile[]     getProfilesByPage($admPageId)
 * @method AdmPage[]        getPagesByProfile($admProfileId)
 */
class AdmPageProfileService
{
    /**
     * @var AdmPageProfileRepository
     */
    private $pageProfileRepository;

    /**
     * @var AdmPageRepository
     */
    private $pageRepository;

    /**
     * @var AdmProfileRepository
     */
    private $profileRepository;

    public function __construct(AdmPageProfileRepository $pageProfileRepository,
        AdmPageRepository $pageRepository, AdmProfileRepository $profileRepository) {
        $this->pageProfileRepository = $pageProfileRepository;
        $this->pageRepository = $pageRepository;
        $this->profileRepository = $profileRepository;
    }
/*
    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
            $item->AdmProfile = $this->profileRepository->find($item->getIdProfile()); 
        }
    }

    public function setTransient(AdmPageProfile $item): void
    {
        $item->AdmPage = $this->pageRepository->find($item->getIdPage()); 
        $item->AdmProfile = $this->profileRepository->find($item->getIdProfile()); 
    }
*/
    /**
     * @return AdmPageProfile[]
     */
    public function findAll()
    {
        $listAdmPageProfile = $this->pageProfileRepository->findAll();
        //$this->setTransientList($listAdmPageProfile);
        return $listAdmPageProfile;
    }

    /**
     * @return AdmProfile[]
     */
    public function getProfilesByPage(int $admPageId)
    {
        $listAdmPageProfile = $this->pageProfileRepository->findByIdPage($admPageId);

        $lista = array();

        foreach ($listAdmPageProfile as $item)
        {
            //$this->setTransient($item);
            array_push($lista, $item->getAdmProfile());
        }

        return $lista;
    }

    /**
     * @return AdmPage[]
     */
    public function getPagesByProfile(int $admProfileId)
    {
        $listAdmPageProfile = $this->pageProfileRepository->findByIdProfile($admProfileId);

        $lista = array();

        foreach ($listAdmPageProfile as $item)
        {
            //$this->setTransient($item);
            array_push($lista, $item->getAdmPage());
        }

        return $lista;
    }    
}