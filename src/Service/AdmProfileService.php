<?php

namespace App\Service;

use App\Entity\AdmProfile;
use App\Repository\AdmProfileRepository;
use App\Service\AdmPageProfileService;
use App\Service\AdmUserProfileService;

class AdmProfileService
{
    /**
     * @var AdmProfileRepository
     */
    private $repository;
    /**
     * @var AdmPageProfileService
     */
    private $pageProfileService;
    /**
     * @var AdmUserProfileService
     */
    private $userProfileService;

    public function __construct(AdmProfileRepository $repository,
        AdmPageProfileService $pageProfileService, AdmUserProfileService $userProfileService) {
        $this->repository = $repository;
        $this->pageProfileService = $pageProfileService;
        $this->userProfileService = $userProfileService;
    }

    /**
     * @return AdmProfile[]
     */
    public function findProfilesByPage(int $pageId)
    {
        $admProfileList = $this->pageProfileService->getProfilesByPage($pageId);
        $this->setTransientList($admProfileList);
        return $admProfileList;
    }

    /**
     * @return AdmProfile[]
     */
    public function findProfilesByUser(int $userId)
    {
        $admProfileList =  $this->userProfileService->getProfilesByUser($userId);
        $this->setTransientList($admProfileList);
        return $admProfileList;
    }

    /**
     * @return MenuItemDTO[]
     */
    public function mountMenuItem(array $listaIdProfile)
    {

    }

    public function setTransientList(array $list): void
    {
        foreach ($list as $item)
        {
            $this->setTransient($item);
        }
    }

    public function setTransient(AdmProfile $item): void
    {
        $listPages = $this->pageProfileService->getPagesByProfile($item->getId());
        foreach ($listPages as $page) {
            array_push($item->getAdmPages(), $page);
        }

        $listProfilePages = array();
        foreach ($listPages as $page) {
            array_push($listProfilePages, $page->getDescription());
        }
        $item->setProfilePages(implode(",", $listProfilePages));

        $listUsers = $this->userProfileService->getUsersByProfile($item->getId());
        foreach ($listUsers as $user) {
            array_push($item->getAdmUsers(), $user);
        }

        $listProfileUsers = array();
        foreach ($listUsers as $user) {
            array_push($listProfileUsers, $user->getName());
        }
        $item->setProfileUsers(implode(",", $listProfileUsers));
    }

}