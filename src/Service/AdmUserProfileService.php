<?php

namespace App\Service;

use App\Entity\AdmUserProfile;
use App\Entity\AdmProfile;
use App\Repository\AdmUserRepository;
use App\Repository\AdmProfileRepository;
use App\Repository\AdmUserProfileRepository;

/**
 * @method AdmUserProfile[] findAll()
 * @method AdmProfile[]     getProfilesByUser($admUserId)
 * @method AdmUser[]        getUsersByProfile($admProfileId)
 */
class AdmUserProfileService
{
    /**
     * @var AdmUserProfileRepository
     */
    private $userProfileRepository;

    /**
     * @var AdmUserRepository
     */
    private $userRepository;

    /**
     * @var AdmProfileRepository
     */
    private $profileRepository;

    public function __construct(AdmUserProfileRepository $userProfileRepository,
        AdmUserRepository $userRepository, AdmProfileRepository $profileRepository) {
        $this->userProfileRepository = $userProfileRepository;
        $this->userRepository = $userRepository;
        $this->profileRepository = $profileRepository;
    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $item->AdmUser = $this->userRepository->find($item->getIdUser()); 
            $item->AdmProfile = $this->profileRepository->find($item->getIdProfile()); 
        }
    }

    public function setTransient(AdmUserProfile $item): void
    {
        $item->AdmUser = $this->userRepository->find($item->getIdUser()); 
        $item->AdmProfile = $this->profileRepository->find($item->getIdProfile()); 
    }

    /**
     * @return AdmUserProfile[]
     */
    public function findAll()
    {
        $listAdmUserProfile = $this->userProfileRepository->findAll();
        $this->setTransientList($listAdmUserProfile);
        return $listAdmUserProfile;
    }

    /**
     * @return AdmProfile[]
     */
    public function getProfilesByUser(int $admUserId)
    {
        $listAdmUserProfile = $this->userProfileRepository->findByIdUser($admUserId);

        $lista = array();

        foreach ($listAdmUserProfile as $item)
        {
            $this->setTransient($item);
            array_push($lista, $item->getAdmProfile());
        }

        return $lista;
    }

    /**
     * @return AdmUser[]
     */
    public function getUsersByProfile(int $admProfileId)
    {
        $listAdmUserProfile = $this->userProfileRepository->findByIdProfile($admProfileId);

        $lista = array();

        foreach ($listAdmUserProfile as $item)
        {
            $this->setTransient($item);
            array_push($lista, $item->getAdmUser());
        }

        return $lista;
    }
}